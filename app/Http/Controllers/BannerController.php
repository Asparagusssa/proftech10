<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Http\Resources\Banner\BannerCollection;
use App\Http\Resources\Banner\BannerResource;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        return new BannerCollection(Banner::with([
            'images' => function ($query) {
                $query->orderByRaw('"order" IS NULL, "order" ASC')->orderBy('id');
            },
            'urls' => function ($query) {
                $query->orderByRaw('"order" IS NULL, "order" ASC')->orderBy('id')->limit(3);
            }
        ])->orderBy('id')->get());
    }

    public function store(BannerRequest $request)
    {
        return new BannerResource(Banner::query()->create($request->validated()));
    }

    public function show(Banner $banner)
    {
        return new BannerResource($banner->load([
            'images' => function ($query) {
                $query->orderByRaw('"order" IS NULL, "order" ASC')->orderBy('id');
            },
            'urls' => function ($query) {
                $query->orderByRaw('"order" IS NULL, "order" ASC')->orderBy('id')->limit(3);
            }
        ]));
    }

    public function update(BannerRequest $request, Banner $banner)
    {
        $banner->update($request->validated());

        return new BannerResource($banner);
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();

        return response()->json();
    }
}
