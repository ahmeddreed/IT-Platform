<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Specialty;
use App\Models\Branch;
class BranchesTable extends Component
{
    public $bTable = true;
    public $addForm = false;
    public $updateForm  = false;
    public $deleteBranch  = false;
    public $Branch_id,$name,$specialty_id,$description,$search;

    public function render(){
        $specialties = Specialty::all();
        if($this->search == null || $this->search ==""){//not be a search
            $branches = Branch::latest()->paginate(10);
        }else{//be a search
            $branches = Branch::where("name",'like', '%'.$this->search.'%')->paginate(10);
        }
        return view('livewire.dashboard.branches-table',compact("specialties","branches"));
    }


    public function showAddForm(){// Show Add Form
        $this->addForm = true;
        $this->bTable = false;
    }

    public function addBranch(){// Create Branch
        $this->validate([//validations Of Data
            'name'=> 'required|unique:branches',
            'specialty_id'=> 'required',
            'description'=> 'required',
        ]);
        // dd($this->name,$this->specialty_id,auth()->id());
        $newBranch = Branch::create([
            "name"=>$this->name,
            "user_id"=>auth()->id(),
            "sp_id"=> $this->specialty_id,
            'description'=> $this->description,
        ]);

        session()->flash("msg_s","تم الاضافة بنجاح");
        $this->canncel();
    }



    public function showUpdateForm($id){// Show Update Form
        $this->Branch_id = $id;
        $this->name = Branch::findOrFail($this->Branch_id)->name;// name of Branch
        $this->specialty_id = Branch::findOrFail($this->Branch_id)->sp_id;// specialty of Branch
        $this->updateForm = true;
        $this->bTable = false;
    }


    public function updateBranch(){//  Update Data Of Specialty

        $this->validate([//validations Of Data
            'name'=> 'required',
            'specialty_id'=> 'required',
            'description'=> 'required',
        ]);
        $updateBranch = Branch::findOrFail($this->Branch_id);//Data of Branch
        $checkOfName = Branch::where("name",$this->name)->count();//count Of Name

        if($checkOfName > 0){// have the name in DB
            if($this->name ==  $updateBranch->name){//not change the name
                //update the Data
                $updateBranch->update([
                    "user_id"=>auth()->id(),
                    "sp_id"=> $this->specialty_id,
                    'description'=> $this->description,
                ]);
                session()->flash("msg_s","تم التحديث  بنجاح");
                $this->canncel();
            }else{
                session()->flash("msg_e","اسم الصلاحية محجوز");
            }

        }else{// the name not exist and change the Data
            $updateBranch->update([
                "name"=>$this->name,
                "user_id"=>auth()->id(),
                "sp_id"=> $this->specialty_id,
                'description'=> $this->description,
            ]);
            session()->flash("msg_s","تم التحديث  بنجاح");
            $this->canncel();
        }
    }



    public function showDeleteMessage($id){// Show Delete Message
        $this->Branch_id = $id;
        $this->deleteBranch = true;
        $this->bTable = false;
    }


    public function deleteBranch(){//  Delete the Branch
        $delBranch = Branch::findOrFail($this->Branch_id);
        $delBranch->delete();
        session()->flash("msg_s","تم الحذف بنجاح");
        $this->canncel();
    }



    public function canncel(){// Show Table
        $this->bTable = true;
        $this->addForm = false;
        $this->updateForm = false;
        $this->deleteBranch = false;
        $this->resetData();
    }


    public function resetData()// Reset the Data
    {
       $this->Branch_id = "";
       $this->name = "";
       $this->specialty_id = "";
       $this->search = "";
    }


}
