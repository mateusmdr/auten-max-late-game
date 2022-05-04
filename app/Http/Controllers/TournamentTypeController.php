<?php

namespace App\Http\Controllers;

use App\Helpers\DBSizes;
use App\Http\Resources\TournamentTypeResource;
use App\Models\TournamentType;
use Illuminate\Http\Request;

class TournamentTypeController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(TournamentType::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $builder = TournamentType::query();

        return TournamentTypeResource::collection($builder->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:0|max:' . DBSizes::STRING
        ]);

        $tournamentType = TournamentType::create($request->only(['name']));

        return new TournamentTypeResource($tournamentType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TournamentType  $tournamentType
     * @return \Illuminate\Http\Response
     */
    public function show(TournamentType $tournamentType)
    {
        return new TournamentTypeResource($tournamentType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TournamentType  $tournamentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TournamentType $tournamentType)
    {
        $request->validate([
            'name' => 'required|string|min:0|max:' . DBSizes::STRING
        ]);

        $tournamentType->name = $request->input('name');
        $tournamentType->save();

        return new TournamentTypeResource($tournamentType); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TournamentType  $tournamentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TournamentType $tournamentType)
    {
        $tournamentType->delete();
    }
}
