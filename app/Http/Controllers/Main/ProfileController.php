<?php

namespace App\Http\Controllers\Main;
use App\Models\User;
use App\Models\Course;
use App\Models\Profile;
use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Models\RegisterCourse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public  $myCourses = [];

    public function profile($id)
    {
        $user = User::find($id);//Data of User
        $courses =$this->getCourse($user->id);

        if($user){//the user is exists
            $dataProfile = Profile::where("user_id",$id); //Data of User Profile
            $specialties = Specialty::all();// all specialties

            //the user set hes specialty
            if($user->specialty !=null){
                $specialty = Specialty::where("id",$user->specialty)->first()->name;//specialty of User
            }else{//the user dont set hes specialty
                $specialty = "لا يوجد تخصص";
            }


            // the user have a profile
            if($dataProfile->exists() != null){
                $dataProfile = Profile::where("user_id",$id)->first(); //Data of User Profile
                return view("main.profile",compact("user","dataProfile","specialties","specialty","courses"));
            }else{// the user dont have a profile
                $createProfile = Profile::create([//create a profile
                    "user_id" => $user->id
                ]);

                $dataProfile = Profile::where("user_id",$id)->first();//Data of User Profile
                return view("main.profile",compact("user","dataProfile","specialties","specialty","courses"));
            }
        }else{//the user is not exists
            return redirect()->back()->with("msg_e","عذرا حصل خطا");
        }


    }


    public function getCourse($user_id){
        $registerCourse = RegisterCourse::where('user_id',$user_id)->get();// get all Course the user register in

        foreach($registerCourse as $rc){
            $course_id = (integer)$rc->course_id;
            $course = Course::find($course_id);
            if($course->count() < 0){
                continue;
            }else{
                $this->myCourses[] = $course;
            }
        }

        return $this->myCourses;
    }


    public function updateUser(Request $request, $id)
    {
        $emailCount = User::where('email',$request->email)->count();
        $userData = User::findOrFail($id);
        //Validations Of Data
        $request->validate([
            'name'=> 'required|max:50|min:6',
            'email'=>'required|email',
            'gender'=>'required',
            'message_show'=>'required',
            'specialty_id'=>'nullable',
            'picture'=>'nullable|image',
        ]);


        if($request->hasFile("picture")){//change the picture
            if(Storage::exists("public/UserPhoto",$userData->picture)){// Delete the Old Picture
                Storage::delete("public/UserPhoto/".$userData->picture);
            }
            //settings of picture

            $file = $request->picture;
            $ext = $file->extension();
            $picture_name = time().".".$ext;
            $file->storeAs("public/UserPhoto", $picture_name);
        }

        if($emailCount > 0){//have this email
            if($userData->email == $request->email){//not change the Email
                // Update User
                $userData->name= $request->name;
                $userData->gender= $request->gender;
                $userData->message_show= $request->message_show;
                $userData->specialty=$request->specialty_id;
                if($request->hasFile("picture")){//change the picture
                    $userData->picture= $picture_name;
                }
                $userData->save();// save the changed
                return redirect()->back()->with("msg_s","تم التحديث  بنجاح");

            }else{//the Email is exists
                return redirect()->back()->with("msg_e","البريد الالكتروني محجوز");
            }
        }else{
           // Update User
           $userData->name= $request->name;
           $userData->email= $request->email;
           $userData->gender= $request->gender;
           $userData->message_show= $request->message_show;
           $userData->specialty=$request->specialty_id;
           if($request->hasFile("picture")){//change the picture
               $userData->picture= $picture_name;
           }
           $userData->save();// save the changed
           return redirect()->back()->with("msg_s","تم التحديث  بنجاح");
        }

    }


    public function updateProfileData(Request $request, $id){
        $dataProfile = Profile::findOrFail($id); //Data of User Profile

        $request->validate([
            'bio'=> 'nullable|string',
            'face_link'=>'nullable|string',
            'insta_link'=>'nullable|string',
            'youtube_link'=>'nullable|string',
        ]);
        //Update the Data
        $dataProfile->update([
            'bio'=>$request->bio,
            'instagram'=>$request->insta_link,
            'facebook'=>$request->face_link,
            'youtube'=>$request->youtube_link,
        ]);
        return redirect()->back()->with("msg_s","تم التحديث  بنجاح");


    }



}
