<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\IsEmpty;

class product_image extends Model
{
    use HasFactory;

    protected $table = "product_image";



public function imageUrl() {
    if (!empty($this->image_name) && file_exists(public_path('gallery/products/' . $this->image_name))) {
        return url('gallery/products/' . $this->image_name);
    } else {
        return '';
    }
}

public static function getSingleImage($id){
    $image = product_image::find($id);
    return $image;
}


}
