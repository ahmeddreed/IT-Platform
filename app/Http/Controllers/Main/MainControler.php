<?php

namespace App\Http\Controllers\Main;
use App\Models\Branch;
use App\Models\Course;
use App\Models\Rating;
use App\Models\Language;
use App\Models\Specialty;
use App\Models\LikeOfCourse;
use Illuminate\Http\Request;
use App\Models\RegisterCourse;
use App\Http\Controllers\Controller;

class MainControler extends Controller
{

    public $search ;


    public function index()
    {
        $courses = Course::latest()->paginate(6,['*'],'Course');
        $like = new LikeOfCourse;
        return view("main.index",compact("courses","like"));
    }



    public function showDetails($id)
    {

        //the Register of Course
        $register = new RegisterCourse;//to Register and Unregister in the Course

        //the Course
        $course = Course::findOrFail($id);//Course Data

        //the Branch
        $branch_data = Branch::find($course->br_id);// branch data of this course
        $branch_name = $branch_data->name;//get the branch name of this course

        //the Language
        $language_data = Language::find($course->lg_id);// language data of this course
        $language_name = $language_data->name;//get the language name of this course

        //the Specialty
        $specialty_data = Specialty::find($branch_data->sp_id);//specialty of this course
        $specialty_name = $specialty_data->name;//get the branch specialty of this course

        //the Rating
        $rating = new Rating;
        $ratingVal =  0.0;//The Rating Value
        $ratingAVG =  0.0;//The Rating Average
        $getRating = Rating::where("course_id",$id)->get();
        // dd($getRating->count());
        if($getRating->count() > 0){//have a Rating
            foreach ($getRating as $item) {
                $ratingVal +=$item->rating_number;
            }
            $ratingAVG = $ratingVal/$getRating->count();
        }else{//no any one Rating
            $ratingVal = 0.0;
            $ratingAVG = 0.0;
        }


        return view("main.show-details",compact("course","branch_name","specialty_name","language_name","register","ratingAVG","rating"));
    }



    public function search(Request $request)//Search of courses
    {
        $request->validate([
            "search"=>'required',
        ]);
        $courses = Course::where("name","like",'%'.$request->search.'%')
        ->OrWhere("description","like",'%'.$request->search.'%')
        ->paginate(6,['*'],'Course');
        $like = new LikeOfCourse;
        return view("main.index",compact("courses","like"));
    }



    public function coursesBySpecialty($id){ //Courses By Specialty Page || id = Specialty-id
        $courses = [];
        $hesCourses = [];
        $branches = Branch::where("sp_id",$id)->get();//Get the branch data of this Specialty

        foreach($branches as $branch){
            if(Course::where("br_id",$branch->id)->exists()){//this branch hava a course
                $courses = Course::where("br_id",$branch->id)->get();
                foreach($courses as $course){//this course have a more course
                    if($course){//course is exist
                        $hesCourses[] = $course;
                    }else{
                        continue;
                    }
                }
            }else{
                continue;
            }
        }

        return view("main.coursesBySpecailty",compact("hesCourses"));
    }


    public function addRating(Request $request,$id){// add and update the rating
        $course =Course::findOrFail($id);//check if this course is exist

        $rating = Rating::where("user_id",auth()->id())->where("course_id",$id);
        if($rating->exists()){//Update
            $rating->update(["rating_number" => $request->number]);
            return redirect()->back()->with("msg_s","تم اضافة تقييمك بنجاح");
        }else{//Create
            $newRating = Rating::create([
                "user_id" => auth()->id(),
                "course_id" =>$id,
                "rating_number"=>$request->number,
            ]);
            return redirect()->back()->with("msg_s","تم اضافة تقييمك بنجاح");
        }


    }



    public function proMap(){
        $specialties = Specialty::all();
        return view("main.programming-map" ,compact("specialties"));
    }

}
