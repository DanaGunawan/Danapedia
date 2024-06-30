<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\SubCategory;
use \App\Models\Category;
use Auth;


class subCategoryControllers extends Controller
{
    public function list(){
        $header_title = 'Sub Category list';
        $subcategories = SubCategory::getSubCategory();
        return view('admin.subCategory.list', ['header_title' => $header_title, 'sub_category' => $subcategories]);
    }

    public function add(){
        $CategoryList = Category::getCategory();  
        return view('admin\subCategory\add',['header_title' => 'Add New Sub Category', 'categoryList' => $CategoryList]);
    }

    public function insert(Request $request){
        
        $request->validate([
            'name' => 'required | unique',
            'slug' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ]);
            
        $category = new subCategory();
        $category->category_id = trim(request('category_id'));
        $category->name = trim(request('name'));
        $category->slug = trim(request('slug'));
        $category->status = trim(request('status'));
        $category->meta_title = trim(request('meta_title'));
        $category->meta_description = trim(request('meta_description'));
        $category->meta_keywords = trim(request('meta_keywords'));
        $category->created_by = Auth::user()->id;
        $category->save();

        return redirect('/admin/subCategory/list')->with('success' , 'sub Category baru sukses dibuat');
        // dd($request->all());

    }

    public function edit($id){
        $CategoryList = Category::getCategory();
        $subCategory = SubCategory::singleSubCategory($id);

        return view('/admin/subCategory/edit',['header_title' => 'Edit Sub Category','categoryList' => $CategoryList, 'singleSubCategory' => $subCategory]);

    
    }



    public function update(Request $request, $id){


        $request->validate([
            'name' => 'required | unique:sub_category,name,'.$id,
            'slug' => 'required | unique:sub_category,slug,'.$id,
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ]);
            
        $category = SubCategory::singleSubCategory($id);
        $category->category_id = trim(request('category_id'));
        $category->name = trim(request('name'));
        $category->slug = trim(request('slug'));
        $category->status = trim(request('status'));
        $category->meta_title = trim(request('meta_title'));
        $category->meta_description = trim(request('meta_description'));
        $category->meta_keywords = trim(request('meta_keywords'));
        $category->created_by = Auth::user()->id;
        $category->save();

        return redirect('/admin/subCategory/list')->with('success', 'Sub Category berhasil di edit');

    }


    public function delete($id){
        $data = SubCategory::find($id);
        $data->is_deleted = 1;
        $data->save();

        return redirect('admin/subCategory/list')->with('success', 'Sub Category berhasil di hapus');
    }
}
