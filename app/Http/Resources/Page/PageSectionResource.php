<?php

namespace App\Http\Resources\Page;

use App\Models\SectionType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\PageSection */
class PageSectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'page_id' => $this->page_id,
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image,
            'type_id' => new SectionTypeResource(SectionType::find($this->section_type_id)),
            'order' => $this->order,
        ];
    }
}
