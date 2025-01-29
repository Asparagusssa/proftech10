<?php

namespace App\Http\Resources\Banner;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\BannerImage */
class BannerImageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'banner_id' => $this->banner_id,
            'image' => $this->image,
            'order' => $this->order,
        ];
    }
}
