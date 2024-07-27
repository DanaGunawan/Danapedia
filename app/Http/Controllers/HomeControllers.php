<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeControllers extends Controller
{
    public function home(){
        $data['meta_title'] = 'Danapedia';
        $data['meta_description'] = 'Dana Pedia e-commerce terbaik';
        $data['meta_keywords'] = 'E-commerce';
        return view('home');
    }
}
