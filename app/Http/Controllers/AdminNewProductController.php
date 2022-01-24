<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminNewProductController extends Controller
{
    public function index()
    {
        return view('admin_new_product');
    }

    public function create(Request $request)
    {
        $new_product_title = request('new_product_title');
        $new_product_information = request('new_product_information');
        $new_product_price = request('new_product_price');
        $new_product_category = request('new_product_category');
        $new_product_color = request('new_product_color');


        $product = new Product;
        $product->name = $new_product_title;
        $product->price = $new_product_price;
        $product->information=$new_product_information;
        $product->color_id = $new_product_color;
        $product->product_category_id = $new_product_category;
        $product->save();

        $product_id = Product::orderBy('created_at','desc')->first()->id;


        for ($i=0; $i<count($_FILES['new_product_file']['name']); $i++) {
            if (empty($_FILES['new_product_file']['name'][$i])){
                return back();
            }
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES['new_product_file']['name'][$i]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                return back();
            }

            $upload_file_name = $_FILES['new_product_file']['name'][$i];
            $hashed_name = md5($upload_file_name.time()).'.'.$imageFileType;

            $upload_path = 'images/'.$hashed_name;
            $dest=getcwd().'\images\\'.$hashed_name;

            if (move_uploaded_file($_FILES['new_product_file']['tmp_name'][$i], $dest)) {
                $new_photo = new Photo;
                $new_photo->name = $upload_file_name;
                $new_photo->path = $upload_path;
                $new_photo->product_id = $product_id;
                $new_photo->save();
            }

        }
        return redirect()->route('admin_product_list_view');
    }
}
