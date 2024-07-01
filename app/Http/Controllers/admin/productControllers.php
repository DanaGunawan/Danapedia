<?php

namespace App\Http\Controllers\admin;

use App\Models\products;
use App\Models\User;
use App\Models\subCategory;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Str;
use Auth;



class productControllers extends Controller
{
    public function list(){
        return view('admin/products/list' , ['header_title' => 'Products List']);
    }

    public function add(){
        return view('admin/products/add', ['header_title' => 'Add New Products']);
    }

    public function insert(Request $request){
        
        $title = trim($request->title);
        $products = new products;
        $products->title = $title;
        $slug = Str::slug($title,'-');
        $created_by = Auth::User()->id;
        $products->save();

        $checkslug = products::slugCount($slug);

        if(empty($checkslug)){
            $products->slug = $slug;
            $products->save();
        }
        else{
            $slug = $slug.'-'. $products->id;
            $products->slug = $slug;
            $products->save();
        }

        return redirect('admin/products/edit/' . $products->id);

    }
    public function edit(){
        return view('admin/products/edit' , ['header_title' => 'Edit Products']);
    }

}



