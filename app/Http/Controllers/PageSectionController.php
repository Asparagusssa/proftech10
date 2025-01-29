<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageSectionRequest;
use App\Http\Resources\Page\PageCollection;
use App\Http\Resources\Page\PageSectionCollection;
use App\Http\Resources\Page\PageSectionResource;
use App\Models\Page;
use App\Models\PageSection;
use App\Service\PageSectionService;

class PageSectionController extends Controller
{
    public function __construct(protected PageSectionService  $pageSectionService)
    {
    }

    public function index(Page $page): PageSectionCollection
    {
        $pageSections = $this->pageSectionService->getAllByPage($page);
        return new PageSectionCollection($pageSections);
    }

    public function store(Page $page, PageSectionRequest $request)
    {
        return new PageSectionResource($this->pageSectionService->create($page, $request));
    }

    public function show(Page $page, $section_id)
    {
        return new PageSectionResource($page->sections()->findOrFail($section_id));
    }

    public function update($page_id, $pageSection_id, PageSectionRequest $request)
    {
        return new PageSectionResource($this->pageSectionService->update($page_id, $pageSection_id, $request));
    }

    public function destroy(Page $page, $section_id)
    {
        $this->pageSectionService->delete($page, $section_id);
        return response()->noContent();
    }

    public function deleteImage(PageSection $pageSection)
    {
        $this->pageSectionService->deleteImage($pageSection);
    }

    public function getAllPages()
    {
        return new PageCollection(Page::with([
            'sections' => function ($query) {
                $query->orderByRaw('"order" IS NULL, "order" ASC')->orderBy('title');
            },
            'seos' => function ($query) {
                $query->orderBy('id');
            }
        ])->orderBy('id')->get());
    }
}
