<?php

namespace App\Models;
use App\Models\product_color;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $table = 'products';


    static public function slugCount($slug){
        return self::where('slug', $slug)->count();
    }

    static public function getProducts(){
        return self::select('products.*','users.name as created_by')->
        join('users','users.id','=','products.created_by')->
        join('category', 'category.id', '=', 'products.category_id')->
        where('products.is_deleted','=' , 0)->
        orderBy('id','desc')->paginate(15)->withQueryString();    
        }

        public static function getProductsFront($categoryId = '', $subCategoryId = '') {
            $query = self::select('products.*', 'users.name as created_by')
                ->join('users', 'users.id', '=', 'products.created_by')
                ->join('category', 'category.id', '=', 'products.category_id')
                ->where('products.is_deleted', 0);
        
            if (!empty($categoryId)) {
                $query->where('products.category_id', $categoryId);
            }
        
            if (!empty($subCategoryId)) {
                $query->where('products.sub_category_id', $subCategoryId);
            }
        
            return $query->orderBy('products.id', 'desc')->paginate(15)->withQueryString();
        }

        static public function getSingleProduct($id){
            return self::find($id);
        }

        public function getColor(){
            return $this->hasMany(product_color::class,'product_id');
        }

        public function getSize(){
            return $this->hasMany(product_size::class,'product_id');
        }

        public function getImage(){
            return $this->hasMany(product_image::class,'product_id')->orderBy('order_by','asc');
        }

        

}

