<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'email_method' => 'array',
        'site_seo_des' => 'array',
        'social_links' => 'array',
        'site_phone' => 'array'
    ];
}
