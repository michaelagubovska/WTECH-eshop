<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index($category_id,Request $request)
    {   $order='default';
        $price = null;
        $product_size = null;
        $product_color = null;
        $per_page = 6;
        $products = Product::with(['category', 'color:id,name', 'inventory', 'photo']);



        $categorized_products = $products->clone()
            ->where('product_category_id','=',$category_id);

        if(request()->has('price')){
            $price = request()->query('price');
            $categorized_products->where('price','<=',$price);
        }
        if(request()->has('product_size')){
            $product_size = request()->query('product_size');

            function get_sizes_list($product_size): array
            {
                $product_list=[];
                $sizes = Inventory::where('size','ilike',$product_size)->get('product_id') ;

                for($i=0;$i<count($sizes);$i++){
                    array_push($product_list, $sizes[$i]->product_id);
                }
                return $product_list;}

            $categorized_products->whereIn('id', get_sizes_list($product_size));

        }
        if(request()->has('product_color')){
            $product_color= request()->query('product_color');
            $categorized_products->where('color_id','=', Color::where('name','ilike',$product_color)->get('id')[0]->id);
        }
        if(request()->has('order')){
            $order = request()->query('order');
            $categorized_products->orderBy('price',$order);
        }
        return view('category')
            ->with('categorized_products', $categorized_products->paginate($per_page));

    }

}
