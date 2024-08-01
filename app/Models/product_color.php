<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_color extends Model
{
    use HasFactory;
    protected $table = 'product_colors';

    public static function deleteColor($product_id){
        $product = self::find($product_id);
    
        if ($product) {
            $product->destroy($product_id);
        }
    }
}
