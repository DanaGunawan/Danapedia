<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\subCategory;

class productControllers extends Controller
{
    public function getCategory($category, $subCategory = ''){
      
        $getCategory = Category::getCategorySlug($category);
        $getSubCategory = subCategory::getSubCategorySlug($subCategory);


        if(!empty($getCategory) && !empty($getSubCategory)){
            $data['getCategory'] = $getCategory;
            $data['getSubCategory'] = $getSubCategory;
            return view('products.category',$data);
        }

        else if(!empty($getCategory)){
            $data['getCategory'] = $getCategory;
            return view('products.category',$data);
        }
        else{
            abort(404);
        }


       
    }
}
