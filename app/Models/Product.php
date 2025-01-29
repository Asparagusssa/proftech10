<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;


    protected $fillable = [
        'category_id', 'title', 'description'
    ];

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->BelongsToMany(Property::class);
    }

    public function relates(): BelongsToMany
    {
        return $this->belongsToMany(Relate::class);
    }




    public function scopeFilter($q): Builder
    {
        if ($properties = request('property')) {
            foreach ((array) $properties as $property) {
                $q->whereHas('properties', function ($q) use ($property) {
                    $q->where('property_id', $property);
                });
            }
        }

        if ($categories = request('category')) {
            $q->whereHas('category', function ($q) use ($categories) {
                $q->whereIn('category_id', (array) $categories);
            });
        }

        if (request('sort')) {
            $q->orderBy(request('sort'));
        } else {
            $q->orderBy('title');
        }

        return $q;
    }
}
