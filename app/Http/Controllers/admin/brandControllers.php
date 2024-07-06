<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\brands;
use Illuminate\Http\Request;
use Auth;
use App\Models\user;

class brandControllers extends Controller
{
    public function list(){
        $brands = brands::getBrands();
        return view('admin.brands.list',['header_title' => 'Brands List' , 'brands' => $brands]);
    }


    public function add(){
        return view('admin.brands.add',['header_title' => 'Add new brands']);
    }

    public function insert(Request $request){

        $request->validate([
            'name' => 'required |unique:brands,name,',
            'slug' => 'required',
          
        ]);
            
        $brands = new brands();
        $brands->name = trim(request('name'));
        $brands->slug = trim(request('slug'));
        $brands->status = trim(request('status'));
        $brands->created_by = Auth::user()->id;
        $brands->save();

        return redirect('/admin/brands/list')->with('success' , 'Brand baru sukses dibuat');
    }   

    public function edit($id){
        $singleBrands = brands::getSingleBrands($id);
        return view('admin\brands\edit' ,['header_title' => 'Edit Brand' , 'singleBrands' => $singleBrands]); 
    }



    public function update(Request $request ,$id){
        $request->validate([
            'name' => 'required |unique:brands,name,'. $id,
            'slug' => 'required',
          
        ]);
            
        $brands = brands::getSingleBrands($id);
        $brands->name = trim(request('name'));
        $brands->slug = trim(request('slug'));
        $brands->status = trim(request('status'));
        $brands->created_by = Auth::user()->id;
        $brands->save();

        return redirect('/admin/brands/list')->with('success' , 'Brand baru sukses di Edit');
    }

    public function delete($id){
        $brands = brands::getSingleBrands($id);
        $brands->is_deleted = 1;
        $brands->save();

        return redirect('/admin/brands/list')->with('success' , 'Brand baru sukses di Delete');
    }

    
}



