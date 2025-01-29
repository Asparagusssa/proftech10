<?php

namespace App\Service;

use App\Http\Requests\RelateRequest;
use App\Http\Resources\Relate\RelateResource;
use App\Models\Relate;

class RelateService
{
    public function getAll()
    {
        return Relate::query()->orderBy('title')->get();
    }

    public function create(RelateRequest $request)
    {
        $data = $request->validated();
        return Relate::query()->create($data);
    }

    public function getOne(Relate $relate)
    {
        return $relate;
    }

    public function update(RelateRequest $request, Relate $relate)
    {
        $data = $request->validated();
        $relate->update($data);
        return new RelateResource($relate);
    }

    public function delete(Relate $relate)
    {
        $relate->delete();

        return response()->json();
    }
}
