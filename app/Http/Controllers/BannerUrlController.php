<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerUrlRequest;
use App\Http\Resources\Banner\BannerUrlCollection;
use App\Http\Resources\Banner\BannerUrlResource;
use App\Models\BannerUrl;
use App\Service\BannerUrlService;

class BannerUrlController extends Controller
{
    public function __construct(protected BannerUrlService $bannerUrlService)
    {
    }

    public function index($banner_id)
    {
        return new BannerUrlCollection($this->bannerUrlService->getAllByBannerId($banner_id));
    }

    public function store($banner_id, BannerUrlRequest $request)
    {
        return new BannerUrlResource($this->bannerUrlService->create($banner_id, $request));
    }

    public function show($banner_id, $url_id)
    {
        return new BannerUrlResource($this->bannerUrlService->getOne($banner_id, $url_id));
    }

    public function update($banner_id, $url_id, BannerUrlRequest $request)
    {
        return new BannerUrlResource($this->bannerUrlService->update($banner_id, $url_id, $request));
    }

    public function destroy($banner_id, $url_id)
    {
        $this->bannerUrlService->delete($banner_id, $url_id);
        return response()->json();
    }
}
