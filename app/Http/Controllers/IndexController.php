<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['photo']);
        $productPhotoList = $products
            ->clone()
            ->inRandomOrder()
            ->limit(10)
            ->get();


        return view('index')->with('productPhotoList', $productPhotoList);
    }
}
