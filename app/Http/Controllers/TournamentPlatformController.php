<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TournamentPlatform;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\TournamentPlatformResource;
use App\Http\Requests\StoreTournamentPlatformRequest;
use App\Http\Requests\UpdateTournamentPlatformRequest;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTournamentPlatformRequest $request)
    {
        $data = $request->only([
            'name',
        ]);

        $data['img_filename'] = $request->file('img')->hashName();

        $disk = Storage::disk('public');
        $disk->putFileAs('', $request->file('img'), $data['img_filename']);

        $tournamentPlatform = TournamentPlatform::create($data);

        return new TournamentPlatformResource($tournamentPlatform);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TournamentPlatform  $tournamentPlatform
     * @return \Illuminate\Http\Response
     */
    public function show(TournamentPlatform $tournamentPlatform)
    {
        return new TournamentPlatformResource($tournamentPlatform);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TournamentPlatform  $tournamentPlatform
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTournamentPlatformRequest $request, TournamentPlatform $tournamentPlatform)
    {
        $data = $request->only([
            'name',
        ]);

        if($request->hasFile('img')) {
            $data['img_filename'] = $request->file('img')->hashName();

            $disk = Storage::disk('public');
            $disk->putFileAs('', $request->file('img'), $data['img_filename']);
            
            $disk->delete($tournamentPlatform->img_filename);
        }

        if(!empty($data)) {
            $tournamentPlatform->update($data);
            $tournamentPlatform->save();
        }

        return new TournamentPlatformResource($tournamentPlatform);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TournamentPlatform  $tournamentPlatform
     * @return \Illuminate\Http\Response
     */
    public function destroy(TournamentPlatform $tournamentPlatform)
    {
        $disk = Storage::disk('public');
        $disk->delete($tournamentPlatform->img_filename);
        
        $tournamentPlatform->delete();
    }
}
