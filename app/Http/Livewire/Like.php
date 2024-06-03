<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LikeOfCourse;
use App\Models\Course;
class Like extends Component
{

    public $course_id;
    public $user_id;
    public $count =0;
    public function render()
    {
        $like = new LikeOfCourse;
        return view('livewire.like',compact("like"));
    }


    public function likes()
    {

        $this->user_id = auth()->id();
        $course = Course::find($this->course_id);
        if($course->exists()){
            $newLike = LikeOfCourse::create([
            "course_id"=>$this->course_id,
            "user_id"=>$this->user_id,
        ]);

       }

       $this->count = LikeOfCourse::where("course_id",$this->course_id)->count();
    }


    public function disLikes(){
        $this->user_id = auth()->id();
        $course = Course::find($this->course_id);
        if($course){
        $delLike = LikeOfCourse::where("course_id",$this->course_id)
        ->where("user_id",$this->user_id);
            if($delLike->exists()){
                $delLike->delete();
            }
        }
    }



}
