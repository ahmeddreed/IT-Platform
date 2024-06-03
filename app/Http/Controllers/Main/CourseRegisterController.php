<?php

namespace App\Http\Controllers\Main;
use App\Models\Course;
use App\Models\RegisterCourse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseRegisterController extends Controller
{
    public function register($course_id =null){//Register of Course
        $course = Course::findOrFail($course_id);//check if course is exist

        $countOfRegister =new RegisterCourse;
        if($countOfRegister->checkCount(auth()->id())){
            $newRegister = RegisterCourse::create([//Create a New Register
                'user_id'=>auth()->id(),
                'course_id'=>$course_id,
            ]);
            return redirect()->back()->with("msg_s","تم الاشتراك  بنجاح");
        }else{
            return redirect()->back()->with("msg_e"," لا يمكن الاشتراك باكثر من خمس كورسات");
        }

    }

    public function unRegister($course_id =null){//UnRegister of Course
        $course = Course::findOrFail($course_id);//check if course is exist
        $delRegister = RegisterCourse::where("user_id",auth()->id())->where("course_id",$course_id);//get a Register
        $delRegister->delete();//Delete This  Register

        return redirect()->back()->with("msg_s","تم الغاء الاشتراك  بنجاح");
    }
}
