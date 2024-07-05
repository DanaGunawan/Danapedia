<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;


class AdminControllers extends Controller
{
    public function list(){return view('admin/admin/list' , ['header_title' => "AdminList",'dataAdmin' => user::getAdmin()]);}
    public function add(){return view('admin/admin/add',['header_title' => 'Add New Admin']);}

    public function insert(Request $request){

        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'name' => 'required',
            'phone' => 'required',
            
        ]);


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->is_admin = 1;
        $user->save();

        return redirect('/admin/admin/list')->with('success' , 'Akun admin berhasil dibuat');
    }

    public function edit($id){
        $singleAdmin = User::SingleAdmin($id);   
        return view('admin/admin/edit',['header_title' => 'Edit Admin','singleAdmin' => $singleAdmin]);

    }
    public function update($id,Request $request){

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'name' => 'required',
            'phone' => 'required',
            
        ]);

        $user = User::SingleAdmin($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->status = $request->status;
        $user->is_admin = 1;
        $user->save();

        return redirect('/admin/admin/list')->with('success' , 'Akun admin berhasil di update');
    }


    public function delete($id){
        User::destroy($id);

        return redirect('/admin/admin/list')->with('success' , 'Akun admin berhasil di Delete');


    }
}
