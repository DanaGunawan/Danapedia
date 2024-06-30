<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
    
}
