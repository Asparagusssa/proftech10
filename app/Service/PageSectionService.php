<?php

namespace App\Service;

use App\Http\Requests\PageSectionRequest;
use App\Http\Resources\Page\PageSectionCollection;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PageSectionService
{
    public function getAllByPage(Page $page)
    {
        return PageSection::where('page_id', $page->id)->orderByRaw('"order" IS NULL, "order" ASC')->orderBy('id')->get();
    }

    public function create(Page $page, PageSectionRequest $request)
    {
        if (!$page->is_changeable) {
            throw ValidationException::withMessages([
                'validation' => 'Данная страница не имеет секций для изменения.'
            ]);
        }
        $data = $request->validated();
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('pageSections', 'public');
        }
        return $page->sections()->create($data);
    }

    public function update($page_id, $pageSection_id, PageSectionRequest $request)
    {
        $page = Page::findOrFail($page_id);
        $pageSection = $page->sections()->findOrFail($pageSection_id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if (isset($pageSection->image)) {
                Storage::disk('public')->delete("pageSections/" . basename($pageSection->image));
            }
            $data['image'] = $request->file('image')->store('pageSections', 'public');
        }

        $pageSection->update($data);
        return $pageSection;
    }

    public function delete(Page $page, $section_id): void
    {
        $pageSection = $page->sections()->findOrFail($section_id);
        if ($pageSection->image) {
            Storage::disk('public')->delete("pageSections/" . basename($pageSection->image));
        }
        $pageSection->delete();
    }

    public function deleteImage(PageSection $pageSection): void
    {
        if (isset($pageSection->image)) {
            Storage::disk('public')->delete('pageSections/' . basename($pageSection->image));
        }
        $pageSection->update([
            'image' => null,
        ]);
    }
}
