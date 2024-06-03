<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Role;
class RolesTable extends Component
{
    public $rTable = true;
    public $addForm = false;
    public $updateForm  = false;
    public $deleteRole  = false;
    public $role_id,$roleName,$search;

    protected $rules=[//of validations
        "roleName" => ['required','min:3','unique:roles,name']
    ];

    public function render()
    {
        if($this->search == null || $this->search ==""){//not be a search
            $roles = Role::latest()->paginate(10);
        }else{//be a search
            $roles = Role::where("name",'like', '%'.$this->search.'%')->paginate(10);
        }

        return view('livewire.dashboard.roles-table',compact("roles"));
    }



    public function addRole(){// Create Role
        $this->validate();
        $newrole = Role::create(["name"=>$this->roleName]);
        $this->rTable = true;
        $this->addForm = false;
        session()->flash("msg_s","تم الاضافة بنجاح");
        $this->canncel();
    }



    public function showAddForm(){// Show Add Form
        $this->addForm = true;
        $this->rTable = false;
    }


    public function showUpdateForm($id){// Show Update Form
        $this->role_id = $id;
        $this->roleName = Role::findOrFail($id)->name;// the of Role
        $this->updateForm = true;
        $this->rTable = false;
    }


    public function showDeleteMessage($id){// Show Delete Message
        $this->role_id = $id;
        $this->deleteRole = true;
        $this->rTable = false;
    }


    public function updateRole(){//  Update the Role
        $this->rules = [
            "roleName" => ['required','min:3']
        ];
        $this->validate();

        $updatRole = Role::findOrFail($this->role_id);// Data of Role
        $checkOfName = Role::where("name",$this->roleName)->count();
        if($checkOfName > 0){// have the name in DB
            if($this->roleName ==  $updatRole->name){//not change the name
                session()->flash("msg_e","لا يوجد تحديث");
            }else{
                session()->flash("msg_e","اسم الصلاحية محجوز");
            }

        }else{// the name not exist
            $updatRole->update([
                "name"=>$this->roleName,
            ]);
            session()->flash("msg_s","تم التحديث  بنجاح");
            $this->canncel();
        }
    }

    public function deleteRole(){//  Delete the Role
      $delRole = Role::findOrFail($this->role_id);
      $delRole->delete();
      session()->flash("msg_s","تم الحذف بنجاح");
      $this->canncel();
    }


    public function canncel(){// Show Table
        $this->rTable = true;
        $this->addForm = false;
        $this->updateForm = false;
        $this->deleteRole = false;
        $this->resetData();
    }


    public function resetData()
    {
       $this->role_id = "";
       $this->roleName = "";
       $this->search = "";
    }

}
