<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\General_settings;
use App\Models\Role;
use App\Models\User;
use App\Models\Specialty;
use App\Models\Branch;
use App\Models\Language;
use App\Models\Course;
class IndexTableController extends Controller
{

    public function index()
    {
        $roleCount = Role::count();
        $userCount = User::count();
        $specialtyCount = Specialty::count();
        $branchCount = Branch::count();
        $languageCount = Language::count();
        $courseCount = Course::count();

        return view("dashboard.index",compact("roleCount","userCount","specialtyCount","branchCount","languageCount","courseCount"));
    }

    public function settings(){
        $dataOfSettings = General_settings::find(1);
        return view("dashboard.settings",compact("dataOfSettings"));
    }

    public function settingsUpdate(Request $request)
    {
        $request->validate([
            "name"=>"required|string",
            "title"=>"required|string",
            "descriptions"=>"required|string",
            "copyRight"=>"required|string",
        ]);

        General_settings::find(1)->update([
            'wbesite_name'=>$request->name,
            'wbesite_title'=>$request->title,
            'wbesite_descriptions'=>$request->descriptions,
            'wbesite_copy_right'=>$request->copyRight,
        ]);

        return redirect()->back()->with("msg_s","تم التحديث  بنجاح");
    }

}
