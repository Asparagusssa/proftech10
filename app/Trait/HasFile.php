<?php

namespace App\Trait;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Foundation\Application;

trait HasFile
{
    public function getFileAttribute($value): Application|string|UrlGenerator|null
    {
        return $value ? url('storage/' . $value) : null;
    }
}
