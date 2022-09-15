<?php

namespace App\Http\Controllers;

use App\Helpers\DBSizes;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Banner::class);
    }

    public function index()
    {
        return BannerResource::collection(Banner::query()->orderBy('position')->get());
    }

    public function store(StoreBannerRequest $request)
    {
        $data = $request->only([
            'title',
            'position',
            'link_url',
        ]);

        $data['img_filename'] = $request->file('img')->hashName();

        $disk = Storage::disk('public');
        $disk->putFileAs('', $request->file('img'), $data['img_filename']);

        $banner = Banner::create($data);

        return new BannerResource($banner);
    }

    public function show(Banner $banner)
    {
        return new BannerResource($banner);
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $data = $request->only([
            'title',
            'position',
            'link_url',
        ]);

        if($request->hasFile('img')) {
            $data['img_filename'] = $request->file('img')->hashName();

            $disk = Storage::disk('public');
            $disk->putFileAs('', $request->file('img'), $data['img_filename']);

            $disk->delete($banner->img_filename);
        }

        if(!empty($data)) {
            $banner->update($data);
            $banner->save();
        }

        return new BannerResource($banner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $disk = Storage::disk('public');
        $disk->delete($banner->img_filename);

        $banner->delete();
    }
}
