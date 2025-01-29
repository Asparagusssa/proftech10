<?php

namespace App\Models;

use App\Trait\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSection extends Model
{
    use HasFactory, HasImage;

    protected $fillable = [
        'page_id', 'title', 'content', 'image', 'section_type_id', 'order',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(SectionType::class);
    }
}
