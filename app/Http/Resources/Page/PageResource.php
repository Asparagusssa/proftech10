<?php

namespace App\Http\Resources\Page;

use App\Http\Resources\Seo\SeoCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Page */
class PageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'sections' => new PageSectionCollection($this->whenLoaded('sections')),
            'seos' => new SeoCollection($this->whenLoaded('seos')),
        ];
    }
}
