<?php

namespace App\Http\Controllers;

use App\Http\Requests\RelateRequest;
use App\Http\Resources\Relate\RelateCollection;
use App\Http\Resources\Relate\RelateResource;
use App\Models\Relate;
use App\Service\RelateService;

class RelateController extends Controller
{
    public function __construct(protected RelateService $relateService)
    {
    }

    public function index()
    {
        return new RelateCollection($this->relateService->getAll());
    }

    public function store(RelateRequest $request)
    {
        return new RelateResource($this->relateService->create($request));
    }

    public function show(Relate $relate)
    {
        return new RelateResource($this->relateService->getOne($relate));
    }

    public function update(RelateRequest $request, Relate $relate)
    {
        return new RelateResource($this->relateService->update($request, $relate));
    }

    public function destroy(Relate $relate)
    {
        $this->relateService->delete($relate);
        return response()->json();
    }
}
