<?php

namespace App\Http\Controllers\admin;

use App\Models\products;
use App\Models\user;
use App\Models\subCategory;
use App\Models\color;
use App\Models\category;
use App\Models\brands;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Str;
use Auth;



class productControllers extends Controller
{
    public function list(){
        $products = products::getProducts();
        return view('admin/products/list' , ['header_title' => 'Products List', 'products' => $products]);
    }

    public function add(){
        $CategoryList = Category::getCategoryActive();  
        $brands = brands::getBrandsActive();
        $colors = color::getColorActive();

        return view('admin/products/add', ['header_title' => 'Add New Products', 'categoryList' => $CategoryList, 'brandList' => $brands, 'colorList' => $colors]);
    }

    public function insert(Request $request){
        
        $title = trim($request->title);
        $products = new products;
        $products->title = $title;
        $slug = Str::slug($title,'-');
        $products->created_by = Auth::user()->id;
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

        return redirect('admin/products/list')->with('success' , 'product baru sukses di buat');
    }

    public function edit($id){
        $getSingleProduct = products::getSingleProduct($id);
        return view('admin/products/edit' , ['header_title' => 'Edit Products', 'getSingleProduct' => $getSingleProduct]);
    }


    public function update($id, Request $request){

    }
    
}



