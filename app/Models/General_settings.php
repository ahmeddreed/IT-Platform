<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General_settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'website_name',
        'website_E_name',
        'website_title',
        'website_descriptions',
        'website_copy_right',
    ];
}
