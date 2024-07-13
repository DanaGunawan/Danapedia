<?php

namespace App\Http\Controllers\admin;

use Str;
use Auth;
use App\Models\user;
use App\Models\color;
use App\Models\brands;
use App\Models\category;
use App\Models\products;
use App\Models\subCategory;
use Illuminate\Http\Request;
use App\Models\product_color;
use App\Http\Controllers\Controller;
use App\Models\product_size;



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
        $products->sku = $request->sku;
        $products->category_id = $request->category_id;
        $products->sub_category_id = $request->subCategory_id;
        $products->brand_id = $request->brand_id;
        $products->price = $request->price;
        $products->old_price = $request->old_price;
        $products->short_description = $request->short_description;
        $products->description = $request->Description;
        $products->additional_information = $request->additional_information;
        $products->shipping_return = $request->shipping_return;
        $products->status = $request->status;

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

        if(!empty($request->color_id)){
            foreach($request->color_id as $color_id){
                $color = new product_color;
                $color->product_id = $products->id;
                $color->color_id = $color_id;
                $color->save();
            }
        }


        return redirect('admin/products/list')->with('success' , 'product baru sukses di buat');
    }





    public function edit($id) {
        $singleProduct = products::getSingleProduct($id);
        $categoryList = Category::getCategoryActive();  
        $brands = brands::getBrandsActive();
        $colors = color::getColorActive();
        $subcategory = subCategory::getSubCategoryconnect($singleProduct->category_id);
       
        return view('admin/products/edit', [
            'header_title' => 'Add New Products',
            'categoryList' => $categoryList,
            'brandList' => $brands,
            'colorList' => $colors,
            'singleProduct' => $singleProduct,
            'subCategory' => $subcategory
        ]);
    }
    

    public function update($id, Request $request){

        // dd($request->all());
        $title = trim($request->title);
        $products = products::getSingleProduct($id);
        $products->title = $title;
        $slug = Str::slug($title,'-');
        $products->sku = $request->sku;
        $products->category_id = $request->category_id;
        $products->sub_category_id = $request->subCategory_id;
        $products->brand_id = $request->brand_id;
        $products->price = $request->price;
        $products->old_price = $request->old_price;
        $products->short_description = $request->short_description;
        $products->description = $request->Description;
        $products->additional_information = $request->additional_information;
        $products->shipping_return = $request->shipping_return;
        $products->status = $request->status;
    
        $products->created_by = Auth::user()->id;
        $products->save();
    
        $checkslug = products::slugCount($slug);
    
        // Delete existing colors for the product
        product_color::where('product_id', $id)->delete();
    
        
        if (!empty($request->color_id)) {
            foreach ($request->color_id as $color_id) {
                $color = new product_color;
                $color->product_id = $products->id;
                $color->color_id = $color_id;
                $color->save();
            }
        }

        product_size::deleteSize($id);

        $sizes = $request->input('size', []);
        $products->getSize()->delete();
        foreach ($sizes as $size) {
            if (!empty($size['size'])) {
                $products->getSize()->create([
                    'size' => $size['size'],
                    'quantity' => $size['quantity'] ?? 0, // Provide default value for quantity
                ]);
            }
        }
        
        if (empty($checkslug)) {
            $products->slug = $slug;
            $products->save();
        } else {
            $slug = $slug . '-' . $products->id;
            $products->slug = $slug;
            $products->save();
        }

    
    
        return redirect('admin/products/list')->with('success', 'Product successfully updated');
    }
    
    
}



