<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $url = Storage::disk('public')->url($this->img_filename);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'link_url' => $this->link_url,
            'img_url' => $url,
            'position' => $this->position
        ];
    }
}
