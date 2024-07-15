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
use App\Models\product_image;



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
        
    // dd($request->all());
    
        $product = new Products();
        $product->title = $request->title;
        $product->sku = $request->sku;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->subCategory_id;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        $product->short_description = $request->short_description;
        $product->Description = $request->Description;
        $product->additional_information = $request->additional_information;
        $product->shipping_return = $request->shipping_return;
        $product->status = $request->status;
        $product->created_by = Auth::user()->id;

        $product->save();

        if (!empty($request->color_id)) {
            foreach ($request->color_id as $color_id) {
                $color = new product_color;
                $color->product_id = $product->id;
                $color->color_id = $color_id;
                $color->save();
            }
        }
    
        foreach ($request->size as $index => $size) {
            // Ensure the size array is not null and contains the necessary keys
            if ($size && isset($size['size']) && isset($size['quantity'])) {
                $productSize = new Product_size();
                $productSize->product_id = $product->id;
                $productSize->size = $size['size'];
                $productSize->quantity = $size['quantity'];
                $productSize->save();
            }   
        }

        if(!empty($product)){
            if(!empty($request->file('image'))){
                foreach($request->file('image') as $value){
                    if($value->isValid()){
                        $ext = $value->getClientOriginalExtension();
                        $randomStr = $product->id.Str::random(20);
                        $filename = strtolower($randomStr).'.'.$ext;

                        $value->move('gallery/products/', $filename);

                        $product_image = new product_image;
                        $product_image->product_id = $product->id;
                        $product_image->image_name = $filename;
                        $product_image->image_extension = $ext;
                        $product_image->save();
                    }
                }
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

        $products = products::getSingleProduct($id);


   
        $title = trim($request->title);
       
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

        foreach ($request->size as $index => $size) {
            // Ensure the size array is not null and contains the necessary keys
            if ($size && isset($size['size']) && isset($size['quantity'])) {
                $productSize = new Product_size();
                $productSize->product_id = $products->id;
                $productSize->size = $size['size'];
                $productSize->quantity = $size['quantity'];
                $productSize->save();
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

        if(!empty($products)){
            if(!empty($request->file('image'))){
                foreach($request->file('image') as $value){
                    if($value->isValid()){
                        $ext = $value->getClientOriginalExtension();
                        $randomStr = $products->id.Str::random(20);
                        $filename = strtolower($randomStr).'.'.$ext;

                        $value->move('gallery/products/', $filename);

                        $product_image = new product_image;
                        $product_image->product_id = $products->id;
                        $product_image->image_name = $filename;
                        $product_image->image_extension = $ext;
                        $product_image->save();



                    }
                }
            }
        }


    
    
        return redirect('admin/products/list')->with('success', 'Product successfully updated');
    }
    
    public function delete($id){
        products::where('id','=',$id)->delete();
        return redirect('admin/products/list')->with('success', 'Product successfully deleted');
    }

    public function delete_image($id){
      $image = product_image::getSingleImage($id);
     if(!empty($image->imageUrl())){
        unlink(public_path('gallery/products/' . $image->image_name));
    }
     $image->delete();

     return redirect()->back()->with('success', 'Product Image successfully deleted');

    }
}



