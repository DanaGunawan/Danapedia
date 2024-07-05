<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class CategoryControllers extends Controller
{
    public function list()
    {
        $categories = Category::getCategory();
        return view('admin.category.list', ['header_title' => 'Category List', 'category' => $categories]);
    }

    public function add()
    {
        return view('admin.category.add', ['header_title' => 'Add New Category']);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:category,name',
            'slug' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ]);

        $category = new Category();
        $category->name = trim($request->input('name'));
        $category->slug = trim($request->input('slug'));
        $category->status = trim($request->input('status'));
        $category->meta_title = trim($request->input('meta_title'));
        $category->meta_description = trim($request->input('meta_description'));
        $category->meta_keywords = trim($request->input('meta_keywords'));
        $category->created_by = Auth::user()->id;
        $category->save();

        return redirect('/admin/category/list')->with('success', 'New category created successfully');
    }

    public function delete($id)
    {
        $category = Category::getSingleCategory($id);
        $category->is_deleted = 1;
        $category->save();

        return redirect('/admin/category/list')->with('success', 'Category deleted successfully');
    }

    public function edit($id)
    {
        $singleCategory = Category::getSingleCategory($id);
        return view('admin.category.edit', ['header_title' => 'Edit Category', 'singleCategory' => $singleCategory]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:category,name,' . $id,
            'slug' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ]);

        $category = Category::getSingleCategory($id);
        $category->name = trim($request->input('name'));
        $category->slug = trim($request->input('slug'));
        $category->meta_description = trim($request->input('meta_description'));
        $category->status = trim($request->input('status'));
        $category->meta_title = trim($request->input('meta_title'));
        $category->meta_description = trim($request->input('meta_description'));
        $category->meta_keywords = trim($request->input('meta_keywords'));
        $category->created_by = Auth::user()->id;
        $category->save();

        return redirect('/admin/category/list')->with('success', 'Category updated successfully');
    }
}
