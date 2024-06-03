<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Branch;
use App\Models\Course;
use Livewire\Component;
use App\Models\Language;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CoursesTable extends Component
{
    use WithFileUploads;

    public $cTable = true;// show Table
    public $addForm = false; //show Add Form
    public $updateForm  = false;//show Update Form
    public $deleteCourse  = false;//show message of delete
    public $course_id,$name,$title,$description,$br_id,$lg_id,$state,$image,$oldImage,$search;// All Field


    public function render()
    {
        $branches = Branch::all();// all Data of Branch
        $languages = Language::all();// all Data of Language

        if($this->search == null || $this->search ==""){//not be a search
            $courses = Course::latest()->paginate(10);
        }else{//be a search
            $courses = Course::where("name",'like', '%'.$this->search.'%')->paginate(10);
        }
        return view('livewire.dashboard.courses-table',compact("branches","languages","courses"));
    }


    public function showAddForm(){// Show Add Form
        $this->addForm = true;
        $this->cTable = false;
    }


    public function createCourse(){// Create Course

        //Validations Of Data
        $this->validate([
            'name'=> 'required|unique:courses|max:50|min:3',
            'title'=>'required',
            'description'=>'required',
            'br_id'=>'required',
            'lg_id'=>'required',
            'state'=>'required',
            'image'=>'required|image',
        ]);

        //settings of image
        $file = $this->image;
        $ext = $file->extension();
        $image_name = time().".".$ext;
        $file->storeAs("public/CoursePhoto", $image_name);
        // dd(Storage::exists("public/UserPhoto/".$picture_name));

        // Create User
        Course::insert([
            "user_id"=>auth()->id(),
            'name'=> $this->name,
            'title'=> $this->title,
            'description'=> $this->description,
            'br_id' => $this->br_id,
            'lg_id'=> $this->lg_id,
            'state'=>$this->state,
            'image'=> $image_name,
        ]);

        session()->flash("msg_s","تم الاضافة بنجاح");
        $this->canncel();
    }


    public function showUpdateForm($id){// Show Update Form
        $this->course_id = $id;
        $dataOfCourse = Course::findOrFail($this->course_id);// Data of this Course
        $this->name = $dataOfCourse->name;// name of Course
        $this->title = $dataOfCourse->title;// title of Course
        $this->description = $dataOfCourse->description;// description of Course
        $this->br_id = $dataOfCourse->br_id;// Branch ID of Course
        $this->lg_id = $dataOfCourse->lg_id;// Language ID of Course
        $this->state = $dataOfCourse->state;// state of Course
        $this->oldImage = $dataOfCourse->image;// image of Course
        $this->updateForm = true;
        $this->cTable = false;
    }


    public function updateCourse(){//Update Data
        //Validations Of Data
        $this->validate([
            'name'=> 'required|max:50|min:3',
            'title'=>'required',
            'description'=>'required',
            'br_id'=>'required',
            'lg_id'=>'required',
            'state'=>'required',
            'image'=>'nullable|image',
        ]);


        if($this->image != null || $this->image != "" ){//change the Image
            if(Storage::exists("public/CoursePhoto",$this->oldImage)){// Delete the Old Image
                Storage::delete("public/CoursePhoto/".$this->oldImage);
            }
            //settings of picture
            $file = $this->image;
            $ext = $file->extension();
            $image_name = time().".".$ext;
            $file->storeAs("public/CoursePhoto", $image_name);
            // dd(Storage::exists("public/UserPhoto/".$picture_name));
        }

        $checkName = Course::where('name',$this->name)->count();
        $courseData = Course::findOrFail($this->course_id);
        if($checkName > 0){
            if($courseData->name == $this->name){//not change the Name
                // Update DAta of Course
                $courseData->title= $this->title;
                $courseData->description= $this->description;
                $courseData->br_id = $this->br_id;
                $courseData->lg_id= $this->lg_id;
                $courseData->state=$this->state;
                if($this->image != null || $this->image != "" ){//change the picture
                    $courseData->image= $image_name;
                }
                $courseData->save();// save the changed
                session()->flash("msg_s","تم التحديث  بنجاح");
                $this->canncel();

            }else{//the Email is exists
                session()->flash("msg_e","البريد الالكتروني محجوز");
            }
        }else{
           // Update DAta of Course
           $courseData->name= $this->name;
           $courseData->title= $this->title;
           $courseData->description= $this->description;
           $courseData->br_id = $this->br_id;
           $courseData->lg_id= $this->lg_id;
           $courseData->state=$this->state;
           if($this->image != null || $this->image != "" ){//change the picture
               $courseData->image= $image_name;
           }
           $courseData->save();// save the changed
           session()->flash("msg_s","تم التحديث  بنجاح");
           $this->canncel();
        }


    }


    public function showDeleteMessage($id){// Show Delete Message
        $this->course_id = $id;
        $this->deleteCourse = true;
        $this->cTable = false;
    }


    public function deleteCourse(){//  Delete the Course
        $delCourse = Course::findOrFail($this->course_id);
        if(Storage::exists("public/CoursePhoto/",$delCourse->image)){// Delete the image in storage file
            Storage::delete("public/CoursePhoto/".$delCourse->image);
        }
        $delCourse->delete();
        session()->flash("msg_s","تم الحذف بنجاح");
        $this->canncel();
    }


    public function canncel(){// Show Table
        $this->cTable = true;
        $this->addForm = false;
        $this->updateForm = false;
        $this->deleteCourse = false;
        $this->resetData();
    }


    public function resetData()// Reset the Data
    {
       $this->course_id = "";
       $this->name = "";
       $this->description = "";
       $this->br_id = "";
       $this->lg_id = "";
       $this->state = "";
       $this->image = "";
       $this->oldImage = "";
       $this->search = "";
    }
}
