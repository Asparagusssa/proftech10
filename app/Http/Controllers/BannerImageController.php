<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerImageRequest;
use App\Http\Resources\Banner\BannerImageCollection;
use App\Http\Resources\Banner\BannerImageResource;
use App\Models\BannerImage;
use App\Service\BannerImageService;

class BannerImageController extends Controller
{
    public function __construct(protected BannerImageService $bannerImageService)
    {
    }

    public function index($banner_id)
    {
        return new BannerImageCollection($this->bannerImageService->getAllByBannerId($banner_id));
    }

    public function store($banner_id, BannerImageRequest $request)
    {
        return new BannerImageResource($this->bannerImageService->create($banner_id, $request));
    }

    public function show($banner_id, $image_id)
    {
        return new BannerImageResource($this->bannerImageService->getOne($banner_id, $image_id));
    }

    public function update($banner_id, $image_id, BannerImageRequest $request)
    {
        return new BannerImageResource($this->bannerImageService->update($banner_id, $image_id, $request));
    }

    public function destroy($banner_id, $image_id)
    {
        $this->bannerImageService->delete($banner_id, $image_id);
        return response()->json();
    }
}
