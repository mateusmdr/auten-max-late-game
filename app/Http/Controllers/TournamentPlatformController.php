<?php

namespace App\Http\Controllers;

use App\Http\Resources\TournamentPlatformResource;
use App\Models\TournamentPlatform;
use Illuminate\Http\Request;

class TournamentPlatformController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(TournamentPlatform::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $builder = TournamentPlatform::query();

        return TournamentPlatformResource::collection($builder->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TournamentPlatform  $tournamentPlatform
     * @return \Illuminate\Http\Response
     */
    public function show(TournamentPlatform $tournamentPlatform)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TournamentPlatform  $tournamentPlatform
     * @return \Illuminate\Http\Response
     */
    public function edit(TournamentPlatform $tournamentPlatform)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TournamentPlatform  $tournamentPlatform
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TournamentPlatform $tournamentPlatform)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TournamentPlatform  $tournamentPlatform
     * @return \Illuminate\Http\Response
     */
    public function destroy(TournamentPlatform $tournamentPlatform)
    {
        //
    }
}
