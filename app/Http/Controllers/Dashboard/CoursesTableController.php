<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Language;
use App\Models\Course;
class CoursesTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();//Branches Data of Table
        $branches = Branch::all();//Branches Data of Form
        $languages = Language::all();//Languages Data of Form
        return view("dashboard.coursesTable",compact("courses","languages","branches"));
    }


}
