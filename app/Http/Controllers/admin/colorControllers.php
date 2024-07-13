<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\color;
use App\Models\user;
use Auth;

class colorControllers extends Controller
{
    public function list(){
        $colors = color::getColor();
        return view('admin\colors\list', ['header_title' => 'List Color' , 'colors' => $colors]);
       }
    
       public function add(){
        return view('admin\colors\add', ['header_title' => 'Add Color']);
       }
    
       public function insert(Request $request){
       
        $request->validate([
            'name' => 'required |unique:colors,name,',
            'code' => 'required',
          
        ]);
            
        $brands = new color();
        $brands->name = trim(request('name'));
        $brands->code = trim(request('code'));
        $brands->status = trim(request('status'));
        $brands->created_by = Auth::user()->id;
        $brands->save();

        return redirect('admin/colors/list')->with('success' , 'color baru sukses dibuat');
       }

       public function edit($id){
        $color = color::find($id);
        return view('admin/colors/edit', ['header_title' => 'Edit Color' , 'singleColors' => $color]);
       }

       public function update(Request $request , $id){
        $request->validate([
            'name' => 'required |unique:colors,name,' . $id,
            'code' => 'required',
        ]);
            
        $brands =  color::find($id);
        $brands->name = trim(request('name'));
        $brands->code = trim(request('code'));
        $brands->status = trim(request('status'));
        $brands->created_by = Auth::user()->id;
        $brands->save();

        return redirect('admin/colors/list')->with('success' , 'color baru sukses di Edit');
       }

       public function delete($id){

        $brands = color::find($id);
        $brands->destroy($id);
        $brands->save();
        return redirect('admin/colors/list')->with('success' , 'color berhasil di hapus');
       }
}
