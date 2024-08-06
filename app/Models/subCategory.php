<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\products;

class subCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_category';
    
    static public function getSubCategory(){
        return self::select('sub_category.*', 'users.name as created_by', 'category.name as category_name')
            ->join('category', 'category.id', '=', 'sub_category.category_id')
            ->join('users', 'users.id', '=', 'category.created_by')
            ->where('sub_category.is_deleted', '=', 0)
            ->orderBy('sub_category.id', 'desc')
            ->paginate(15)->withQueryString();
    }

    static public function singleSubCategory($id){
        return subCategory::find($id);
    }
    
    public static function getSubCategorySlug($slug){
        return self::where('slug','=',$slug)->
        where('sub_category.is_deleted','=' , 0)->
        where('sub_category.status' ,'=' , 'Active')->first();
     }


    static public function getSubCategoryconnect($id)
    {
        return self::select('sub_category.*')
            ->where('sub_category.is_deleted', '=' ,0)
            ->where('sub_category.status', '=' ,'Active')
            ->where('sub_category.category_id', '=' , $id)
            ->orderBy('sub_category.id', 'desc')
            ->get();
    }

    public function CountProduct(){
        return $this->hasMany(Products::class, 'sub_category_id')
        ->where('products.status', '=' ,'Active')
        ->where('products.is_deleted', '=' ,0)
        ->count();
    }
    
}
