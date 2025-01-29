<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Banner extends Model
{
    protected $fillable = [
        'title', 'description',
    ];

    use HasFactory;

    public function images(): HasMany
    {
        return $this->hasMany(BannerImage::class);
    }

    public function urls(): HasMany
    {
        return $this->hasMany(BannerUrl::class);
    }
}
