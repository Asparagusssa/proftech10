<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Email extends Model
{
    protected $fillable = [
        'email',
    ];

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(EmailType::class, 'email_email_type');
    }
}
