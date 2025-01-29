<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionTypeRequest;
use App\Http\Resources\Page\SectionTypeCollection;
use App\Http\Resources\Page\SectionTypeResource;
use App\Models\SectionType;

class SectionTypeController extends Controller
{
    public function index()
    {
        return new SectionTypeCollection(SectionType::orderBy('title')->get());
    }

    public function store(SectionTypeRequest $request)
    {
        return new SectionTypeResource(SectionType::create($request->validated()));
    }

    public function show($sectionType_id)
    {
        $sectionType = SectionType::findOrFail($sectionType_id);
        return new SectionTypeResource($sectionType);
    }

    public function update(SectionTypeRequest $request, $sectionType_id)
    {
        $sectionType = SectionType::findOrFail($sectionType_id);
        $sectionType->update($request->validated());
        return new SectionTypeResource($sectionType);
    }

    public function destroy($sectionType_id)
    {
        $sectionType = SectionType::findOrFail($sectionType_id);
        $sectionType->delete();
        return response()->json();
    }
}
