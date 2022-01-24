<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $per_page = 6;
        $products = Product::with(['category', 'color:id,name', 'inventory', 'photo']);

        if(request()->has('search_bar')){
            $search_bar = request()->query('search_bar');
            $products->where('name','ilike','%'.$search_bar.'%');
        }
        return view('search')
            ->with('categorized_products', $products->paginate($per_page));
    }
}
