<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Language;
use App\Models\Branch;
use App\Models\LanguageToBranch;
class JoinBranchWithLanguage extends Component
{
    public $jTable = true;
    public $addForm = false;
    public $updateForm  = false;
    public $deleteJoin  = false;
    public $join_id,$name,$branch_id,$language_id,$search;

    public function render()
    {
        $branches = Branch::all();
        $languages = Language::all();

        if($this->search == null || $this->search ==""){//not be a search
            $joins = LanguageToBranch::latest()->paginate(10);
        }else{//be a search
            $joins = LanguageToBranch::where("name",'like', '%'.$this->search.'%')->paginate(10);
        }
        return view('livewire.dashboard.join-branch-with-language',compact("branches","languages","joins"));
    }


    public function showAddForm(){// Show Add Form
        $this->addForm = true;
        $this->jTable = false;
    }

    public function addJoin(){// Create Join
        $this->validate([//validations Of Data
            'branch_id'=> 'required',
            'language_id'=> 'required',
        ]);

        $brancgName = Branch::findOrFail($this->branch_id)->name;
        $languageName = Language::findOrFail($this->language_id)->name;
        $this->name = $brancgName.'-'.$languageName;// Name Of Join

        if(LanguageToBranch::where('name',$this->name)->count() > 0){//ckeck if this join is exist
            session()->flash("msg_e","اسم الربط محجوز");
        }else{
            $newJoin = LanguageToBranch::create([
                "name"=>$this->name,
                "user_id"=>auth()->id(),
                "branch_id"=> $this->branch_id,
                'language_id'=> $this->language_id,
            ]);
            session()->flash("msg_s","تم الاضافة بنجاح");
            $this->canncel();
            }
    }


    public function showUpdateForm($id){// Show Update Form
        $this->join_id = $id;
        $this->name = LanguageToBranch::findOrFail($this->join_id)->name;// name of Branch
        $this->branch_id = LanguageToBranch::findOrFail($this->join_id)->branch_id;// specialty of Branch
        $this->language_id = LanguageToBranch::findOrFail($this->join_id)->language_id;// specialty of Branch
        $this->updateForm = true;
        $this->jTable = false;
    }


    public function updateJoin(){//  Update Data Of Join

        $this->validate([//validations Of Data
            'branch_id'=> 'required',
            'language_id'=> 'required',
        ]);

        $brancgName = Branch::findOrFail($this->branch_id)->name;
        $languageName = Language::findOrFail($this->language_id)->name;
        $this->name = $brancgName.'-'.$languageName;//new Name Of Join

        $updateJoin = LanguageToBranch::findOrFail($this->join_id);//Data of Branch
        $checkOfName = LanguageToBranch::where('name',$this->name)->count();//count Of Name

        if($checkOfName > 0){// have the name in DB
            if($this->name ==  $updateJoin->name){//not change the name
                //update the Data
                $updateJoin->update([
                    "user_id"=>auth()->id(),
                    "branch_id"=> $this->branch_id,
                    'language_id'=> $this->language_id,
                ]);
                session()->flash("msg_s","تم التحديث  بنجاح");
                $this->canncel();
            }else{
                session()->flash("msg_e","اسم الربط محجوز");
            }

        }else{// the name not exist and change the Data

            $updateJoin->update([
                "name"=>$this->name,
                "user_id"=>auth()->id(),
                "branch_id"=> $this->branch_id,
                'language_id'=> $this->language_id,
            ]);
            session()->flash("msg_s","تم التحديث  بنجاح");
            $this->canncel();
        }
    }


    public function showDeleteMessage($id){// Show Delete Message
        $this->join_id = $id;
        $this->deleteJoin = true;
        $this->jTable = false;
    }


    public function deleteJoin(){//  Delete the Join
        $delJoin = LanguageToBranch::findOrFail($this->join_id);
        $delJoin->delete();
        session()->flash("msg_s","تم الحذف بنجاح");
        $this->canncel();
    }


    public function canncel(){// Show Table
        $this->jTable = true;
        $this->addForm = false;
        $this->updateForm = false;
        $this->deleteJoin = false;
        $this->resetData();
    }


    public function resetData()// Reset the Data
    {
       $this->join_id = "";
       $this->name = "";
       $this->Branch_id = "";
       $this->language_id = "";
       $this->search = "";
    }

}
