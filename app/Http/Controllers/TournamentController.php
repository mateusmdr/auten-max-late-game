<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use Carbon\Carbon;
use Cron\CronExpression;
use App\Models\Tournament;
use App\Models\Notification;
use Illuminate\Http\Request;
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

    public function index(Request $request)
    {
        $qtd = $request->query('qtd', 5);

        $filters = $request->only([
            'tournament_recurrence_id_null',
            'tournament_recurrence_id_present',
            'is_approved_is',
            'date_equals',
            'tournament_platform_id_equals',
            'buy_in_gte',
            'buy_in_ste',
            'tournament_type_id_equals',
        ]);

        $builder = Tournament::query();

        if($request->has('enabled_notifications')) {
            $callback = function($query) {
                $query->select(DB::raw(1))
                    ->from('notifications')
                    ->whereColumn('tournament_id', 'tournaments.id')
                    ->where('user_id', '=', Auth::user()->id);
            };
            if($request->boolean('enabled_notifications')) {
                $builder->whereExists($callback);
            }else {
                $builder->whereNotExists($callback);
            }
        }

        foreach($filters as $filter=>$value) {
            $filter = explode('_', $filter);
            if(count($filter) < 2) continue;

            $comparison = array_pop($filter);
            $field = implode('_', $filter);

            if(str_contains('date',$field)) {
                $value = Carbon::createFromFormat("d/m/Y", $value);
            }
            switch($comparison) {
                case 'like':
                    $builder->where($field, 'like', $value);
                    break;
                case 'gte':
                    $builder->where($field, '>=', $value);
                    break;
                case 'ste':
                    $builder->where($field, '<=', $value);
                    break;
                case 'gt':
                    $builder->where($field, '>', $value);
                    break;
                case 'st':
                    $builder->where($field, '<', $value);
                    break;
                case 'equals':
                    $builder->where($field, '=', $value);
                    break;
                case 'is':
                    $builder->where($field, $value);
                    break;
                case 'null':
                    $builder->whereNull($field);
                    break;
                case 'present':
                    $builder->whereNotNull($field);
                    break;
            }
        }

        if(!Auth::user()->is_admin) {
            $builder->where('is_approved',true);
        }
        $builder->whereDate('date','>=', today());
        $builder->where(function ($query) {
            $query->whereTime('subscription_end_at','>=',now())
                ->orWhereDate('date','>',today());
        });

        return TournamentResource::collection($builder->orderBy('date')->orderBy('name')->simplePaginate($qtd));
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

    public function destroyAfter(Tournament $tournament)
    {
        $this->authorizeResource(Tournament::class, 'destroy');
        $tournament->tournament_recurrence->tournaments->where('date','>=',$tournament->date)->map->delete();
    }

    public function enableNotification(EnableNotificationRequest $request, Tournament $tournament) {
        $data = $request->only([
            'before',
            'after',
            'interval',
            'option',
            'schedule'
        ]);

        if($tournament->tournament_recurrence !== null && $data['option'] !== 'one') {
            if($data['option'] === 'all') {
                $tournament->tournament_recurrence->tournaments->map->createNotification($data);
            }else { // Custom
                $tournaments = $tournament->tournament_recurrence->tournaments;
                $cron = new CronExpression($data['schedule']);
                $weekdays = explode(",",$cron->getParts()[4]);
                foreach ($tournaments as $t) {
                    if(in_array(Carbon::parse($t->date)->dayOfWeek, $weekdays)) {
                        $t->createNotification($data);
                    }
                }
            }
        }else {
            $tournament->createNotification($data);
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
