<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\General_settings;
class SettingsController extends Controller
{
   public function settings(){
    $dataOfSettings = General_settings::find(1);
    return view("dashboard.settings",compact("dataOfSettings"));
   }
}
