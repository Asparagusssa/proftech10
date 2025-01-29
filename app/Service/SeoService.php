<?php

namespace App\Service;

use App\Http\Requests\SeoRequest;
use App\Http\Resources\Seo\SeoCollection;
use App\Http\Resources\Seo\SeoResource;
use App\Models\Page;
use App\Models\Seo;

class SeoService
{
    public function getAllByPageId($page_id)
    {
        $page = Page::findOrFail($page_id);
        return $page->seos()->orderBy('id')->get();
    }

    public function store($page_id, SeoRequest $request)
    {
        $page = Page::findOrFail($page_id);
        return $page->seos()->create($request->validated());
    }

    public function getOne($page_id, $seo_id)
    {
        $page = Page::findOrFail($page_id);
        return $page->seos->findOrFail($seo_id);
    }

    public function update($page_id, $seo_id, $request)
    {
        $page = Page::findOrFail($page_id);
        $seo = $page->seos->findOrFail($seo_id);
        $seo->update($request->validated());
        return $seo;
    }

    public function delete($page_id, $seo_id): void
    {
        $page = Page::findOrFail($page_id);
        $seo = $page->seos->findOrFail($seo_id);
        $seo->delete();
    }

    public function getAll()
    {
        return Seo::orderBy('id')->get();
    }
}
