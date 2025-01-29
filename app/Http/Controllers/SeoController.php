<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeoRequest;
use App\Http\Resources\Seo\SeoCollection;
use App\Http\Resources\Seo\SeoResource;
use App\Models\Page;
use App\Models\Seo;
use App\Service\SeoService;

class SeoController extends Controller
{
    public function __construct(protected SeoService $seoService)
    {
    }

    public function index($page_id)
    {
        return new SeoCollection($this->seoService->getAllByPageId($page_id));
    }

    public function store($page_id, SeoRequest $request)
    {
        return new SeoResource($this->seoService->store($page_id, $request));
    }

    public function show($page_id, $seo_id)
    {
        return new SeoResource($this->seoService->getOne($page_id, $seo_id));
    }

    public function update($page_id, $seo_id, SeoRequest $request)
    {
        return new SeoResource($this->seoService->update($page_id, $seo_id, $request));
    }

    public function destroy($page_id, $seo_id)
    {
        $this->seoService->delete($page_id, $seo_id);
        return response()->noContent();
    }

    public function getAll()
    {
        return new SeoCollection($this->seoService->getAll());
    }
}
