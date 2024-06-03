<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageToBranch extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'branch_id',
        'language_id'
    ];
}
