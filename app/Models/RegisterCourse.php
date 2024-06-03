<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Exists;

class RegisterCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
    ];

    // check if this user is Register in this course
    public function check($user_id,$course_id)
    {
        return $this->where("user_id",$user_id)->where("course_id",$course_id)->exists();
    }

    //check how many Course have this user
    public function checkCount($user_id){
        $count = RegisterCourse::where("user_id",$user_id)->count();
        // dd($count);
        //the user can Register to only five Courses
        if($count >= 5){
            return false;
        }else{
            return true;
        }
    }
}
