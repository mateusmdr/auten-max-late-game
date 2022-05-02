<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Http\Requests\StoreTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;
use App\Http\Resources\TournamentResource;

class TournamentController extends Controller
{

    public function __construct()
    {
        // $this->authorizeResource(Tournament::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $builder = Tournament::query();

        return TournamentResource::collection($builder->get());
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
            'recurrence_schedule',
            'ends_at',
        ]);

        $tournament = Tournament::create($data);

        return new TournamentResource($tournament);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        //
    }
}
