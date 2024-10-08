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
            
            $getProducts = Products::getProductsFront($getCategory->id);

            $page = 0;
         
            if(!empty($getProducts->nextPageUrl())){
                $parse_url = parse_url($getProducts->nextPageUrl());
                if(!empty($parse_url['query'])){
                    parse_str($parse_url['query'], $page_array);
                    $page = !empty($page_array['page']) ? $page_array['page'] : '';
                }
            }
            $data['page'] = $page;
            $data['product_data'] = $getProducts; 
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

            $getProducts = Products::getProductsFront($getCategory->id);

            $page = 0;
         
            if(!empty($getProducts->nextPageUrl())){
                $parse_url = parse_url($getProducts->nextPageUrl());
                if(!empty($parse_url['query'])){
                    parse_str($parse_url['query'], $page_array);
                    $page = !empty($page_array['page']) ? $page_array['page'] : '';
                }
            }
            $data['page'] = $page;

            $data['product_data'] = $getProducts;     
            $data['sub_category_filter'] =  subCategory::getSubCategoryconnect($getCategory->id);
            return view('products.list',$data);

        }
        else{
            abort(404);
        }     
    }

    public function ProductFilteringAjax(Request $request){
        $getProducts = Products::getProductsFront();

        $page = 0;
     
        if(!empty($getProducts->nextPageUrl())){
            $parse_url = parse_url($getProducts->nextPageUrl());
            if(!empty($parse_url['query'])){
                parse_str($parse_url['query'], $page_array);
                $page = !empty($page_array['page']) ? $page_array['page'] : '';
            }
        }
        $data['page'] = $page;
        $data['product_data'] = $getProducts;            

         return response()->json([
            'status' => true,
            'page' => $page,
            'success' => view('products._list',["product_data" => $getProducts])->render(),
        ],200);
    }
}
