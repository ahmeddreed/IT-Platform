<?php

namespace App\Http\Controllers\Main;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommentOfCourse;
use App\Models\Course;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course_id)
    {
        $comments = CommentOfCourse::where("course_id",$course_id)->get();

        $courseData = Course::find($course_id);
        return view("main.Comment",compact("courseData","comments"));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addComment(Request $request,$course_id)
    {
        $courseData = Course::find($course_id);
        if(!$courseData){//the course is not exsit
            return redirect()->back()->with("msg_e","عذرا حصل خطا");
        }else{//the course is exsit

            $request->validate([//validate Data
                "comment"=>"required|max:290",
            ]);

            $newComment = CommentOfCourse::create([
                'user_id'=> auth()->id(),
                'course_id'=>$course_id,
                'comment'=>$request->comment,
            ]);

            return redirect()->back()->with("msg_s","تم اضافة التعليق بنجاح");
        }
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function DelComment(Request $request,$id,$course_id)
    {
        $delComment = CommentOfCourse::find($id);//get data of comment by comrent id

        if($delComment->course_id ==$course_id && $delComment->user_id == auth()->id()){//check if this course and of this user
            $delComment->delete();
            return redirect()->back()->with("msg_s","تم  الحذف بنجاح");
        }
        else// if happen any error
            return redirect()->back()->with("msg_e","عذرآ حدث خطأ");

    }
}
