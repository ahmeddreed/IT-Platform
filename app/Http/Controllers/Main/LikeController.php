<?php

namespace App\Http\Controllers\Main;
use App\Models\LikeOfCourse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likeOfCourse($user_id,$course_id){
        $newLike = LikeOfCourse::create([
            "user_id" => $user_id,
            "course_id" => $course_id
        ]);
    }
}
