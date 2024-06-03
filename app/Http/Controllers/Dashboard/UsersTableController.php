<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Specialty;
class UsersTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate();//Users Data of Table
        $specialties = Specialty::all();//Specialties Data of Create and Update Form
        $roles = Role::all();//Roles Data of Create and Update Form

        return view("dashboard.usersTable",compact("users","specialties","roles"));
    }


}
