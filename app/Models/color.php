<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class color extends Model
{
    use HasFactory;

    protected $table = 'colors';

    public static function getColor(){
        return self::select('colors.*','users.name as created_by')->
        join('users','users.id','=','colors.created_by')->
        where('colors.is_deleted','=' , 0)->
        orderBy('id','desc')->paginate(15)->withQueryString();
    }

    public static function getSingleColor($id){
        return self::find($id);
    }
}
