<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\subCategory;

class productControllers extends Controller
{
    public function CategoryData($category, $subCategory = ''){
      
        $getCategory = Category::getCategorySlug($category);
        $getSubCategory = subCategory::getSubCategorySlug($subCategory);

        if(!empty($getCategory) && !empty($getSubCategory)){
            $data['getCategory'] = $getCategory;
            $data['getSubCategory'] = $getSubCategory;
            $data['meta_title'] = $getSubCategory->meta_title;
            $data['meta_description'] = $getSubCategory->meta_description;
            $data['meta_keywords'] = $getSubCategory->meta_keywords;
            return view('products.category',$data);

        }

        else if(!empty($getCategory)){
            $data['getCategory'] = $getCategory;
            $data['meta_title'] = $getCategory->meta_title;
            $data['meta_description'] = $getCategory->meta_description;
            $data['meta_keywords'] = $getCategory->meta_keywords;
            return view('products.category',$data);
        }
        else{
            abort(404);
        }


       
    }
}
