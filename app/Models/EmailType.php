<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EmailType extends Model
{
    protected $fillable = [
        'type',
    ];

    public function emails(): BelongsToMany
    {
        return $this->belongsToMany(Email::class, 'email_email_type');
    }
}
