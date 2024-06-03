<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Branch;
use Livewire\Component;
use App\Models\Language;
use App\Models\LanguageToBranch;

class LanguagesTable extends Component
{
    public $lTable = true;
    public $addForm = false;
    public $updateForm  = false;
    public $deleteLanguage  = false;
    public $language_id,$name,$description,$branches_id,$search;


    public function render()
    {
        $branches = Branch::all();
        if($this->search == null || $this->search ==""){//not be a search
            $languages = Language::latest()->paginate(10);
        }else{//be a search
            $languages = Language::where("name",'like', '%'.$this->search.'%')->paginate(10);
        }
        return view('livewire.dashboard.languages-table',compact("languages","branches"));
    }



    public function showAddForm(){// Show Add Form
        $this->addForm = true;
        $this->lTable = false;
    }


    public function addLanguage(){// Create Language
        $this->validate([//validations Of Data
            'name'=> 'required|unique:languages',
            'description'=> 'required',
            'branches_id'=> 'required|array',
        ]);
        // dd($this->branches_id);
        $newLanguage = Language::create([// Createing
            "name"=>$this->name,
            "user_id"=>auth()->id(),
            'description'=> $this->description,
        ]);

        foreach($this->branches_id as $branch_id){
            $branchData = Branch::findOrFail($branch_id);
            $joinName = $branchData->name."-".$this->name;

            $newJoin = LanguageToBranch::create([
                "name"=>$joinName,
                "user_id"=>auth()->id(),
                "branch_id"=> $branch_id,
                'language_id'=> $newLanguage->id,
            ]);

        }

        session()->flash("msg_s","تم الاضافة بنجاح");
        $this->canncel();
    }


    public function showUpdateForm($id){// Show Update Form
        $this->language_id = $id;
        $this->name = Language::findOrFail($this->language_id)->name;// name of language
        $this->updateForm = true;
        $this->lTable = false;
    }



    public function updateLanguage(){//  Update Data Of Language

        $this->validate([//validations Of Data
            'name'=> 'required',
            'description'=> 'required',
        ]);
        $updateLanguage = Language::findOrFail($this->language_id);//Data of Language
        $checkOfName = Language::where("name",$this->name)->count();//count Of Name

        if($checkOfName > 0){// have the name in DB
            if($this->name ==  $updateLanguage->name){//not change the name
                $updateLanguage->update([
                    "user_id"=>auth()->id(),
                    'description'=> $this->description,
                ]);
                session()->flash("msg_s","تم التحديث  بنجاح");
                $this->canncel();
            }else{
                session()->flash("msg_e","اسم الصلاحية محجوز");
            }

        }else{// the name not exist
            $updateLanguage->update([
                "name"=>$this->name,
                "user_id"=>auth()->id(),
                'description'=> $this->description,
            ]);
            session()->flash("msg_s","تم التحديث  بنجاح");
            $this->canncel();
        }
    }



    public function showDeleteMessage($id){// Show Delete Message
        $this->language_id = $id;
        $this->deleteLanguage = true;
        $this->lTable = false;
    }


    public function deleteLanguage(){//  Delete the Language
        $delLanguage = Language::findOrFail($this->language_id);
        $delLanguage->delete();
        session()->flash("msg_s","تم الحذف بنجاح");
        $this->canncel();
    }


    public function canncel(){// Show Table
        $this->lTable = true;
        $this->addForm = false;
        $this->updateForm = false;
        $this->deleteLanguage = false;
        $this->resetData();
    }


    public function resetData()
    {
       $this->language_id = "";
       $this->name = "";
       $this->search = "";
    }
}
