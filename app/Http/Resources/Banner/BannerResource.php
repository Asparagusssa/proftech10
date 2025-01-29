<?php

namespace App\Http\Resources\Banner;

use App\Http\Controllers\BannerUrlController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Banner */
class BannerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'images' => new BannerImageCollection($this->whenLoaded('images')),
            'urls' => new BannerUrlCollection($this->whenLoaded('urls')),
        ];
    }
}
