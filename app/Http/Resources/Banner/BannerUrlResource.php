<?php

namespace App\Http\Resources\Banner;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\BannerUrl */
class BannerUrlResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'banner_id' => $this->banner_id,
            'title' => $this->title,
            'url' => $this->url,
            'image' => $this->image,
            'order' => $this->order,
        ];
    }
}
