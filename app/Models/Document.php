<?php

namespace App\Models;

use App\Trait\HasFile;
use App\Trait\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory, HasImage, HasFile;

    protected $fillable = [
        'title', 'description', 'image', 'file', 'filename', 'order',
    ];
}
