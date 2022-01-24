<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductListController extends Controller
{
    public function index(Request $request){
        $products = Product::with(['color','category'])->orderBy('updated_at','desc');
        if(request('search_bar')){
            $products->where('name','ilike','%'.request('search_bar').'%');
        }

        return view('admin_product_list')
            ->with('products',$products->get());
    }

}
