<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Resources\AdResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Ad::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $builder = Ad::query();
        $builder->where('end_at', '>=', now());

        if(!Auth::user()->is_admin) {
            $builder->where('begin_at', '<=', now());
            $ad = $builder->inRandomOrder()->first();

            return new AdResource($ad);
        }

        return AdResource::collection($builder->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdRequest $request)
    {
        $data = $request->only([
            'link_url',
            'begin_at',
            'end_at',
            'price',
            'company_name'
        ]);

        $data['img_filename'] = $request->file('img')->hashName();

        $disk = Storage::disk('public');
        $disk->putFileAs('', $request->file('img'), $data['img_filename']);

        $ad = Ad::create($data);

        return new AdResource($ad);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdRequest $request, Ad $ad)
    {
        $data = $request->only([
            'link_url',
            'begin_at',
            'end_at',
            'price',
            'company_name'
        ]);

        if($request->hasFile('img')) {
            $data['img_filename'] = $request->file('img')->hashName();

            $disk = Storage::disk('public');
            $disk->putFileAs('', $request->file('img'), $data['img_filename']);
            
            $disk->delete($ad->img_filename);
        }

        if(!empty($data)) {
            $ad->update($data);
            $ad->save();
        }

        return new AdResource($ad);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        $disk = Storage::disk('public');
        $disk->delete($ad->img_filename);
        
        $ad->delete();
    }
}
