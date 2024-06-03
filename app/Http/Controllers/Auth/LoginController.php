<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("auth.login");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $request->validate([ //Validate Data
            'email'=>'required|email',
            'password'=>'required|min:6|max:16',
        ]);

        $user = User::all()->where("email" ,'=', $request->email)->first();//get Data of user
        $user_c = User::all()->where("email" ,'=', $request->email)->count();//

        if ($user_c > 0 ){//check email
            if(Hash::check($request->password, $user->password)){//check password
               Auth::attempt([
                "email"=> $request->email,
                "password"=> $request->password,
               ]);//login is successfuly

               if($user->role_id == 3)//user redirect
               {
                   return redirect()->route("profile", ["id"=>$user->id])->with("msg_s","  تم الدخول بنجاح ");

               }else{//Super Admin or Admin redirect

                return redirect()->route("dashboard.index",["id" => $user->id])->with("msg_s","  تم الدخول بنجاح ");
               }

            }else{//the password in invalid
                return redirect()->back()->with("msg_e", "عذرا الرمز السري خطا");
            }
        }else{//the email in invalid
             return redirect()->back()->with("msg_e", "عذرا الايميل خطا");
        }
    }

    public function logout()
    {

        Auth::logout();//user logout
        return view("auth.login")->with("msg_s","تم تسجيل الخروج بنجاح");
    }

}
