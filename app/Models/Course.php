<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'user_id',
        'description',
        'br_id',
        'lg_id',
        'image',
        'state'
    ];
}
