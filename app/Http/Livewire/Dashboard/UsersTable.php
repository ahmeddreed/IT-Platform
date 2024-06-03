<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Models\Specialty;
use Livewire\WithFileUploads;

class UsersTable extends Component
{
    use WithFileUploads;
    public $uTable = true;// show Table
    public $addForm = false; //show Add Form
    public $updateForm  = false;//show Update Form
    public $deleteUser  = false;//show message of delete
    public $user_id,$name,$email,$password,$role_id,$specialty_id,$gender,$picture,$oldPicture,$search;// All Field
    public function render()
    {
        if($this->search == null || $this->search ==""){//not be a search
            $users = User::latest()->paginate(10);
        }else{//be a search
            $users = User::where("name",'like', '%'.$this->search.'%')
            ->orWhere('email','like','%'.$this->search.'%')
            ->paginate(10);
        }
        $roles = Role::all();
        $specialties = Specialty::all();
        return view('livewire.dashboard.users-table',compact("users","roles","specialties"));
    }


    public function showAddUser(){// to show Add Form
        $this->uTable = false;
        $this->addForm =true ;
    }

    public function createUser(){// create a new User

        //Validations Of Data
        $this->validate([
            'name'=> 'required|max:50|min:4',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:16',
            'gender'=>'required',
            'role_id'=>'required',
            'specialty_id'=>'nullable',
            'picture'=>'required|image',
        ]);

        //settings of picture
        $file = $this->picture;
        $ext = $file->extension();
        $picture_name = time().".".$ext;
        $file->storeAs("public/UserPhoto", $picture_name);
        // dd(Storage::exists("public/UserPhoto/".$picture_name));

        // Create User
        User::insert([
            'name'=> $this->name,
            'email'=> $this->email,
            'role_id' => $this->role_id,
            'password'=> Hash::make($this->password),
            'gender'=> $this->gender,
            'specialty'=>$this->specialty_id,
            'picture'=> $picture_name,
        ]);

        session()->flash("msg_s","تم الاضافة بنجاح");
        $this->canncel();
    }


    public function showUpdateUser($id){// to show Update Form
        $this->user_id =$id;
        $this->uTable = false;
        $this->updateForm =true;

        //Get All Data Of this User
        $dUser = User::findOrFail($this->user_id);
        $this->name = $dUser->name;
        $this->email = $dUser->email;
        $this->role_id = $dUser->role_id;
        $this->gender = $dUser->gender;
        $this->oldPicture = $dUser->picture;
        $this->specialty_id = $dUser->specialty;

    }


    public function updateUser(){//Update Data
        // dd($this->name,  $this->email,$this->role_id,$this->gender,$this->specialty_id);
        //Validations Of Data
        $this->validate([
            'name'=> 'required|max:50|min:4',
            'email'=>'required|email',
            'gender'=>'required',
            'role_id'=>'required',
            'specialty_id'=>'nullable',
            'picture'=>'nullable|image',
        ]);


        if($this->picture != null || $this->picture != ""){//change the picture
            if(Storage::exists("public/UserPhoto",$this->oldPicture)){// Delete the Old Picture
                Storage::delete("public/UserPhoto/".$this->oldPicture);
            }
            //settings of picture
            $file = $this->picture;
            $ext = $file->extension();
            $picture_name = time().".".$ext;
            $file->storeAs("public/UserPhoto", $picture_name);
            // dd(Storage::exists("public/UserPhoto/".$picture_name));
        }else{//not change the picture
            $picture_name = "";
        }

        $emailCount = User::where('email',$this->email)->count();
        $userData = User::findOrFail($this->user_id);
        if($emailCount > 0){
            if($userData->email == $this->email){//not change the Email
                // Update User
                $userData->name= $this->name;
                $userData->role_id = $this->role_id;
                $userData->gender= $this->gender;
                $userData->specialty=$this->specialty_id;
                if($this->picture != null || $this->picture != ""){//change the picture
                    $userData->picture= $picture_name;
                }
                $userData->save();// save the changed
                session()->flash("msg_s","تم التحديث  بنجاح");
                $this->canncel();

            }else{//the Email is exists
                session()->flash("msg_e","البريد الالكتروني محجوز");
            }
        }else{
           // Update User
           $userData->name= $this->name;
           $userData->email= $this->email;
           $userData->role_id = $this->role_id;
           $userData->gender= $this->gender;
           $userData->specialty=$this->specialty_id;
           if($this->picture != null || $this->picture != ""){//change the picture
               $userData->picture= $picture_name;
           }
           $userData->save();// save the changed
           session()->flash("msg_s","تم التحديث  بنجاح");
           $this->canncel();
        }


    }


    public function showDeleteUser($id){// to show Message of Delete
        $this->user_id =$id;
        $this->uTable = false;
        $this->deleteUser =true ;
    }


    public function deleteUser(){//Delete Data
        $delUser = User::findOrFail($this->user_id);
        if(Storage::exists("public/UserPhoto",$delUser->picture)){// Delete the Picture in storage file
            Storage::delete("public/UserPhoto/".$delUser->picture);
        }
        $delUser->delete();
        session()->flash("msg_s","تم الحذف بنجاح");
        $this->canncel();

    }


    public function canncel(){//show the Table and close a other item
        $this->uTable = true;
        $this->addForm = false;
        $this->updateForm  = false;
        $this->deleteUser  = false;
        $this->resetData();
    }


    public function resetData(){// to empty all data
        $this->user_id ="";
        $this->name = "";
        $this->email = "";
        $this->password = "";
        $this->role_id = "";
        $this->specialty_id = "";
        $this->gender = "";
        $this->picture = "";
    }

}
