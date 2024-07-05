<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brands extends Model
{
    use HasFactory;

    protected $table = 'brands';


     public static function getBrands(){
        return self::select('brands.*','users.name as created_by')->
        join('users','users.id','=','brands.created_by')->
        where('brands.is_deleted','=' , 0)->
        orderBy('id','desc')->paginate(15)->withQueryString();
    }

    public static function getSingleBrands($id){
        return self::select('brands.*', 'users.name as created_by')
            ->join('users', 'users.id', '=', 'brands.created_by')
            ->where('brands.id', $id)
            ->orderBy('brands.id', 'desc')
            ->first();
    }
}
