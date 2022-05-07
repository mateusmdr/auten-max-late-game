<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
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
        if(Auth::user()->is_admin) {
            $begin = (new DateTime($this->begin_at))->format('d/m/Y');
            $end = (new DateTime($this->end_at))->format('d/m/Y');

            return [
                'id' => $this->id,
                'company_name' => $this->company_name,
                'link_url' => $this->link_url,
                'begin_at' => $begin,
                'end_at' => $end,
                'price' => $this->price,
                'img_url' => $url,
            ];
        }

        return [
            'link_url' => $this->link_url,
            'img_url' => $url,
        ];
    }
}
