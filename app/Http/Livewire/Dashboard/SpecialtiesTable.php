<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Specialty;
class SpecialtiesTable extends Component
{
    public $spTable = true;
    public $addForm = false;
    public $updateForm  = false;
    public $deleteSpecialty  = false;
    public $specialty_id,$name,$description,$search;


    public function render()
    {
        if($this->search == null || $this->search ==""){//not be a search
            $specialties = Specialty::latest()->paginate(10);
        }else{//be a search
            $specialties = Specialty::where("name",'like', '%'.$this->search.'%')->paginate(10);
        }

        return view('livewire.dashboard.specialties-table',compact("specialties"));
    }


    public function showAddForm(){// Show Add Form
        $this->addForm = true;
        $this->spTable = false;
    }

    public function addSpecialty(){// Create Specialty
        $this->validate([//validations Of Data
            'name'=> 'required|unique:specialties',
            'description'=> 'required',
        ]);
        $newSpecialty = Specialty::create([
            "name"=>$this->name,
            "user_id"=>auth()->id(),
            'description'=> $this->description,
        ]);
        session()->flash("msg_s","تم الاضافة بنجاح");
        $this->canncel();
    }


    public function showUpdateForm($id){// Show Update Form
        $this->specialty_id = $id;
        $this->name = Specialty::findOrFail($this->specialty_id)->name;// name of Specialty
        $this->updateForm = true;
        $this->spTable = false;
    }


    public function updateSpecialty(){//  Update Data Of Specialty

        $this->validate([//validations Of Data
            'name'=> 'required',
            'description'=> 'required',
        ]);
        $updateSpecialty = Specialty::findOrFail($this->specialty_id);//Data of Specialty
        $checkOfName = Specialty::where("name",$this->name)->count();//count Of Name

        if($checkOfName > 0){// have the name in DB
            if($this->name ==  $updateSpecialty->name){//not change the name
                $updateSpecialty->update([
                    'description'=> $this->description,
                ]);
                session()->flash("msg_s","تم التحديث  بنجاح");
                $this->canncel();
            }else{
                session()->flash("msg_e","اسم الصلاحية محجوز");
            }

        }else{// the name not exist
            $updateSpecialty->update([
                "name"=>$this->name,
                'description'=> $this->description,
            ]);
            session()->flash("msg_s","تم التحديث  بنجاح");
            $this->canncel();
        }
    }


    public function showDeleteMessage($id){// Show Delete Message
        $this->specialty_id = $id;
        $this->deleteSpecialty = true;
        $this->spTable = false;
    }


    public function deleteSpecialty(){//  Delete the Specialty
        $delSpecialty = Specialty::findOrFail($this->specialty_id);
        $delSpecialty->delete();
        session()->flash("msg_s","تم الحذف بنجاح");
        $this->canncel();
    }



    public function canncel(){// Show Table
        $this->spTable = true;
        $this->addForm = false;
        $this->updateForm = false;
        $this->deleteSpecialty = false;
        $this->resetData();
    }


    public function resetData()
    {
       $this->specialty_id = "";
       $this->name = "";
       $this->search = "";
    }
}
