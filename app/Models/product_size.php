<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_size extends Model
{
    use HasFactory;

    protected $table = "product_sizes";
    protected $fillable = ['size','quantity'];

    public static function deleteSize($product_id){
        self::where('product_id','=',$product_id)->delete();
    }

}
