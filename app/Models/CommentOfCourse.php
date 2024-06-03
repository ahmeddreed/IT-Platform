<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class CommentOfCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'comment'
    ];


    public function comment($user_id,$comment_user_id){

        return $user_id == $comment_user_id;
    }


}
