<?php

namespace App\Service;

use App\Http\Requests\BannerUrlRequest;
use App\Models\Banner;
use App\Models\BannerUrl;
use Illuminate\Support\Facades\Storage;

class BannerUrlService
{
    public function getAllByBannerId(int $banner_id)
    {
        $banner = Banner::findOrFail($banner_id);
        return $banner->urls()->orderByRaw('"order" IS NULL, "order" ASC')->orderBy('id')->get();
    }

    public function create(int $banner_id, BannerUrlRequest $request)
    {
        $banner = Banner::findOrFail($banner_id);
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('bannerUrlImages', 'public');
        return $banner->urls()->create($data);
    }

    public function getOne(int $banner_id, int $url_id)
    {
        $banner = Banner::findOrFail($banner_id);
        return $banner->urls()->findOrFail($url_id);
    }

    public function update(int $banner_id, int $ulr_id, BannerUrlRequest $request)
    {
        $banner = Banner::findOrFail($banner_id);
        $image = $banner->urls()->findOrFail($ulr_id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete("bannerUrlImages/" . basename($image->image));
            $data['image'] = $request->file('image')->store('bannerUrlImages', 'public');
        }
        $image->update($data);
        return $image;
    }

    public function delete(int $banner_id, int $url_id)
    {
        $banner = Banner::findOrFail($banner_id);
        $image = $banner->urls()->findOrFail($url_id);
        if ($image->image) {
            Storage::disk('public')->delete("bannerUrlImages/" . basename($image->image));
        }
        $image->delete();
    }
}
