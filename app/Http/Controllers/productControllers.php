<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\subCategory;
use App\Models\products;
use App\Models\Color;
use App\Models\Brands;

class productControllers extends Controller
{
    public function CategoryData($category, $subCategory = ''){
      
        $getCategory = Category::getCategorySlug($category);
        $getSubCategory = subCategory::getSubCategorySlug($subCategory);
        $getColor = Color::getColorActive();
        $getBrands = Brands::getBrandsActive();

        if(!empty($getCategory) && !empty($getSubCategory)){
            $data['getCategory'] = $getCategory;
            $data['getSubCategory'] = $getSubCategory;
            $data['getColor'] = $getColor;
            $data['getBrands'] = $getBrands;
            $data['meta_title'] = $getSubCategory->meta_title;
            $data['meta_description'] = $getSubCategory->meta_description;
            $data['meta_keywords'] = $getSubCategory->meta_keywords;
            $data['product_data'] = Products::getProductsFront($getCategory->id,$getSubCategory->id);
            $data['sub_category_filter'] =  subCategory::getSubCategoryconnect($getCategory->id);
            
            return view('products.list',$data);

        }

        else if(!empty($getCategory)){
            $data['getCategory'] = $getCategory;
            $data['meta_title'] = $getCategory->meta_title;
            $data['getColor'] = $getColor;
            $data['getBrands'] = $getBrands;
            $data['meta_description'] = $getCategory->meta_description;
            $data['meta_keywords'] = $getCategory->meta_keywords;
            $data['product_data'] = Products::getProductsFront($getCategory->id);
            $data['sub_category_filter'] =  subCategory::getSubCategoryconnect($getCategory->id);
            return view('products.list',$data);

        }
        else{
            abort(404);
        }     
    }

    public function ProductFilteringAjax(Request $request){
        $getproduct = Products::getProductsFront();
        return response()->json([
            'status' => true,
            'success' => view('products._list',["product_data" => $getproduct])->render(),

        ],200);
    }
}
