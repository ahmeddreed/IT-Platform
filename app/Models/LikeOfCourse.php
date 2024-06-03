<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Course;
class LikeOfCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
    ];

    public function isLiked($user_id,$course_id){// is user liked
        $ckeck = $this->where("user_id",$user_id)
        ->where("course_id",$course_id)
        ->exists();
       return $ckeck;
    }

    public function countOfLike($course_id){//count of the course
        $count = $this->where("course_id",$course_id)->count();
       return $count;
    }
}
