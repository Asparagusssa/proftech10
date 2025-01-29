<?php

namespace App\Trait;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Foundation\Application;

trait HasImage
{
    public function getImageAttribute($value): Application|string|UrlGenerator|null
    {
        return $value ? url('storage/' . $value) : null;
    }
}
