<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use Cron\CronExpression;
use App\Models\Tournament;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use App\Models\TournamentRecurrence;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TournamentResource;
use Illuminate\Console\Scheduling\Schedule;
use App\Http\Requests\StoreTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;
use App\Http\Requests\EnableNotificationRequest;
use App\Http\Requests\DisableNotificationRequest;
use DateInterval;

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
        $builder->whereDate('date','>=',today()->toDateString());

        return TournamentResource::collection($builder->orderBy('date')->orderBy('name')->get());
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
            'min_buy_in',
            'max_buy_in',
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
                $ends_at = new DateTime($data['ends_at']);
                $date = new DateTime($data['date']);

                $tournamentData = [];

                $recurrence = TournamentRecurrence::create($data);
                $fourteenDays = DateInterval::createFromDateString('14 days');

                $weekdays = explode(" ",$data['schedule']);
                $weekdays = $weekdays[array_key_last($weekdays)];
                $weekdays = explode(",",$weekdays);

                unset($data['is_recurrent']);
                unset($data['schedule']);
                unset($data['ends_at']);

                foreach($weekdays as $weekday) {
                    $weekdayDate = clone $date;
                    // set to first day of week
                    $weekdayDate->setISODate((int)$weekdayDate->format('o'), (int)$weekdayDate->format('W'), 0);
                    // set to next weekday occurence
                    $weekdayDate->modify('- 7 days');
                    $weekdayDate->modify('+'.($weekday).' days');

                    do {
                        $tournamentData[] = array_merge(
                            $data,
                            [
                                'tournament_recurrence_id' => $recurrence->id,
                                'date' => $weekdayDate->format('Y-m-d')
                            ]
                        );
                        $weekdayDate->add($fourteenDays);
                    }while($weekdayDate->diff($ends_at)->format('%R') == '+');
                }

                Tournament::insert($tournamentData);
            }else if($data['is_recurrent']) {

                $ends_at = new DateTime($data['ends_at']);
                $date = new DateTime($data['date']);
            
                $recurrence = TournamentRecurrence::create($data);

                $cron = new CronExpression($data['schedule']);
                
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
            'min_buy_in',
            'max_buy_in',
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