<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\users;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';


    public static function getCategory(){
        return self::select('category.*','users.name as created_by')->
        join('users','users.id','=','category.created_by')->
        where('category.is_deleted','=' , 0)->
        orderBy('id','desc')->paginate(15)->withQueryString();
    }


    public static function getCategoryActive(){
        return self::select('category.*')->
        where('category.is_deleted','=' , 0)->
        where('category.status' ,'=' , 'Active')->
        orderBy('id','desc')->paginate(15)->withQueryString();
    }

    public static function getCategoryFront(){
        return self::select('category.*')->
        where('category.is_deleted','=' , 0)->
        where('category.status' ,'=' , 'Active')->get();
    }



    public static function getSingleCategory($id){
        return self::select('category.*', 'users.name as created_by')
            ->join('users', 'users.id', '=', 'category.created_by')
            ->where('category.id', $id)
            ->orderBy('category.id', 'desc')
            ->first();
    }

    public function getSubCategory(){
        return $this->hasMany(subCategory::class,'category_id')->where('sub_category.status', '=', 'Active')->where('sub_category.is_deleted', '=','0');
    }

    
    
}
