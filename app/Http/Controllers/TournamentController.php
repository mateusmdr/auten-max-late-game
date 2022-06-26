<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use Carbon\Carbon;
use Cron\CronExpression;
use App\Models\Tournament;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use App\Models\TournamentRecurrence;
use Illuminate\Support\Facades\Auth;
use Crazynds\IntervalExpression\Interval;
use App\Http\Resources\TournamentResource;
use Illuminate\Console\Scheduling\Schedule;
use App\Http\Requests\StoreTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;
use App\Http\Requests\EnableNotificationRequest;
use App\Http\Requests\DisableNotificationRequest;

class TournamentController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Tournament::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $builder = Tournament::query();
        if(!Auth::user()->is_admin) {
            $builder->where('is_approved',true);
        }
        $builder->whereDate('date','>=', now());
        $builder->whereTime('subscription_end_at','>=', now());

        return TournamentResource::collection($builder->orderBy('date')->get());
    }

    public function show(Tournament $tournament){
        return new TournamentResource($tournament);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTournamentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTournamentRequest $request)
    {
        $data = $request->only([
            'name',
            'prize',
            'buy_in',
            'date',
            'subscription_begin_at',
            'subscription_end_at',
            'tournament_platform_id',
            'tournament_type_id',
            'is_recurrent',
            'schedule',
            'ends_at',
        ]);

        DB::transaction(function () use ($data) {
            if(isset($data['schedule']) && str_contains($data['schedule'], '*/15')) {
                $interval = new Interval();
                $weekdays = explode(" ",$data['schedule']);
                $weekdays = $weekdays[array_key_last($weekdays)];

                $expression = '2 weekly ' .$weekdays;
                $interval->parse($expression);

                $ends_at = new Carbon($data['ends_at']);
                $date = new Carbon($data['date']);

                $generator = $interval->generator($date, $ends_at);

                $tournamentData = [];

                $recurrence = TournamentRecurrence::create($data);

                unset($data['is_recurrent']);
                unset($data['schedule']);
                unset($data['ends_at']);

                if(in_array($date->dayOfWeek, explode(",",$weekdays))) {
                    $next = $generator->current();
                    $tournamentData[] = array_merge(
                        $data,
                        [
                            'tournament_recurrence_id' => $recurrence->id,
                            'date' => $next->toDateString()
                        ]
                    );
                }

                $generator->next();
                do {
                    $next = $generator->current();

                    $tournamentData[] = array_merge(
                        $data,
                        [
                            'tournament_recurrence_id' => $recurrence->id,
                            'date' => $next->toDateString()
                        ]
                    );
                }while($generator->next());

                Tournament::insert($tournamentData);
            }else if($data['is_recurrent']) {

                $ends_at = new DateTime($data['ends_at']);
                $date = new Carbon($data['date']);
                $date = $date->subDay();
            
                $recurrence = TournamentRecurrence::create($data);

                $cron = new CronExpression($data['schedule']);
                $date = $cron->getNextRunDate($date);
                
                $tournamentData = [];

                unset($data['is_recurrent']);
                unset($data['schedule']);
                unset($data['ends_at']);

                do {
                    $tournamentData[] = array_merge(
                        $data,
                        [
                            'tournament_recurrence_id' => $recurrence->id,
                            'date' => $date->format('Y-m-d')
                        ]
                    );
                    
                    $date = $cron->getNextRunDate($date);

                }while($date->diff($ends_at)->format('%R') == '+');

                Tournament::insert($tournamentData);
            }else {
                unset($data['is_recurrent']);
                unset($data['schedule']);
                unset($data['ends_at']);
                
                Tournament::create($data);
            }
        });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTournamentRequest  $request
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTournamentRequest $request, Tournament $tournament)
    {
        $data = $request->only([
            'is_approved',
            'name',
            'prize',
            'buy_in',
            'date',
            'subscription_begin_at',
            'subscription_end_at',
            'tournament_platform_id',
            'tournament_type_id',
        ]);
        
        if(!empty($data)) {
            $tournament->update($data);
            $tournament->save();
        }

        return new TournamentResource($tournament);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        $tournament->delete();
    }

    public function enableNotification(EnableNotificationRequest $request, Tournament $tournament) {
        $data = $request->only([
            'before',
            'after',
            'interval'
        ]);

        $notificationData = [
            'type' => 'tournament',
            'tournament_id' => $tournament->id,
            'user_id' => Auth::user()->id
        ];

        if($data['before'] ?? false){
            $notificationData['datetime'] =
                Carbon::parse($tournament->date)->setTimeFrom($tournament->subscription_begin_at);
            
            Notification::create($notificationData);
        }

        if($data['after'] ?? false) {
            $notificationData['datetime'] = 
                Carbon::parse($tournament->date)->setTimeFrom($tournament->subscription_end_at)
                ->subMinutes($data['interval']);

            Notification::create($notificationData);
        }
    }

    public function disableNotification(DisableNotificationRequest $request, Tournament $tournament) {
        $all = $request->input('all',false);

        if($all && ($tournament->tournament_recurrence_id !== null)) {
            $tournaments = $tournament->tournament_recurrence->tournaments;

            foreach ($tournaments as $tr) {
                Notification::query()->whereBelongsTo($tr)->delete();
            }
            return;
        }

        Notification::query()->whereBelongsTo($tournament)->delete();
    }
}