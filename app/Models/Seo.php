<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seo extends Model
{
    protected $fillable = [
        'page_id', 'name', 'content',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
