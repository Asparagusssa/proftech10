<?php

namespace App\Models;

use App\Trait\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BannerImage extends Model
{
    protected $fillable = [
        'banner_id', 'image', 'order',
    ];

    use HasFactory, HasImage;

    public function banner(): BelongsTo
    {
        return $this->belongsTo(Banner::class);
    }
}
