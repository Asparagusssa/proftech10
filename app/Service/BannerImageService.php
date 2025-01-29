<?php

namespace App\Service;

use App\Http\Requests\BannerImageRequest;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerImageService
{
    public function getAllByBannerId(int $banner_id)
    {
        $banner = Banner::findOrFail($banner_id);
        return $banner->images()->orderByRaw('"order" IS NULL, "order" ASC')->orderBy('id')->get();
    }

    public function create(int $banner_id, BannerImageRequest $request)
    {
        $banner = Banner::findOrFail($banner_id);
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('bannerImages', 'public');
        return $banner->images()->create($data);
    }

    public function getOne(int $banner_id, int $image_id)
    {
        $banner = Banner::findOrFail($banner_id);
        return $banner->images()->findOrFail($image_id);
    }

    public function update(int $banner_id, int $image_id, BannerImageRequest $request)
    {
        $banner = Banner::findOrFail($banner_id);
        $data = $request->validated();
        $image = $banner->images()->findOrFail($image_id);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete("bannerImages/" . basename($image->image));
            $data['image'] = $request->file('image')->store('bannerImages', 'public');
        }
        $image->update($data);
        return $image;
    }

    public function delete(int $banner_id, int $image_id)
    {
        $banner = Banner::findOrFail($banner_id);
        $image = $banner->images()->findOrFail($image_id);
        if ($image->image) {
            Storage::disk('public')->delete("bannerImages/" . basename($image->image));
        }
        $banner->images()->where('id', $image_id)->delete();
    }
}
