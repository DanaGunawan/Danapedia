<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardControllers extends Controller
{
    public function dashboard(){
      
        return view('admin.dashboard',['header_title' => "dashboard"]);
    }

  
}

