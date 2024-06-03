<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Specialty;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialties =Specialty::all();
        return view("auth.register",compact("specialties"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {
        $role_id =3;//User
        $request->validate([
            'name'=> 'required|max:50|min:6',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:16',
            'gender'=>'required',
            'specialty'=>'nullable',
            'photo'=>'required|image',
        ]);


        $file = $request->photo;
        $ext = $file->extension();
        $image_name = time().".".$ext;
        $file->storeAs("public/UserPhoto/", $image_name);


        User::insert([// insert the data
            'name'=> $request->name,
            'email'=> $request->email,
            'role_id' => $role_id,
            'password'=> Hash::make($request->password),
            'gender'=> $request->gender,
            'specialty'=>$request->specialty,
            'picture'=> $image_name,
        ]);

        return redirect()->route("login")->with("msg_s","تم انشاء الحساب بنجاح  ");// redirect to login page

    }


}
