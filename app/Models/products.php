<?php

namespace App\Models;
use App\Models\product_color;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

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
            $query = self::select('products.*', 'users.name as sell_by','category.slug as category_slug','category.name as category_name',
                'sub_category.slug as sub_category_slug','sub_category.name as sub_category_name')
                ->join('users', 'users.id', '=', 'products.created_by')
                ->join('category', 'category.id', '=', 'products.category_id')
                ->join('sub_category','sub_category.id' ,'=','products.sub_category_id');
        
            if (!empty($categoryId)) {
                $query->where('products.category_id', $categoryId);
            }
        
            if (!empty($subCategoryId)) {
                $query->where('products.sub_category_id', $subCategoryId);
            }
          
        
            if(!empty(Request::get('ajax_sub_category_id'))){
                $ajax_sub_category_id = rtrim(Request::get("ajax_sub_category_id"), ',');
                $ajax_sub_category_id_array = explode(',', $ajax_sub_category_id);
                $query = $query->whereIn('products.sub_category_id', $ajax_sub_category_id_array);
            }

            else{
                if (!empty(Request::get('old_sub_category_id'))) {
                    $query = $query->where('products.sub_category_id','=', Request::get('old_sub_category_id'));
                }
                if (!empty(Request::get('old_category_id'))) {
                 $query =   $query->where('products.category_id', '=',Request::get('old_category_id'));
                }   

            }

            if(!empty(Request::get('ajax_color_id'))){
                $ajax_color_id = rtrim(Request::get("ajax_color_id"), ',');
                $ajax_color_id_array = explode(',', $ajax_color_id);
                $query = $query->join('product_colors','product_colors.product_id','=','products.id');
                $query = $query->whereIn('products.colors', $ajax_color_id_array);
            }
            if(!empty(Request::get('ajax_brand_id'))){
                $ajax_brand_id = rtrim(Request::get('ajax_brand_id'),',');
                $ajax_brand_id_array = explode(',', $ajax_brand_id);
                $query = $query->whereIn('products.brand_id', $ajax_brand_id_array);
            }
            if(!empty(Request::get('ajax_start_price') && Request::get('ajax_end_price'))){
                $start_price = str_replace('Rp','',Request::get('ajax_start_price'));
                $end_price = str_replace('Rp','',Request::get('ajax_end_price'));
                $query = $query->where('products.price','>=',$start_price);
                $query = $query->where('products.price','<=',$end_price);

            }

            return $query->where('products.is_deleted', 0)
            ->where('products.status', 'Active')
            ->orderBy('products.id', 'desc')
            ->groupBy('products.id')
            ->paginate(1)
            ->withQueryString();
        }


        static public function getSingleImage($id){
            return product_image::where('product_id', $id)->orderBy('order_by','asc')->first();
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

