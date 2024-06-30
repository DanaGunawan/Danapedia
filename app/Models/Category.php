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

    public static function getSingleCategory($id){
        return self::select('category.*', 'users.name as created_by')
            ->join('users', 'users.id', '=', 'category.created_by')
            ->where('category.id', $id)
            ->orderBy('category.id', 'desc')
            ->first();
    }
    
}
