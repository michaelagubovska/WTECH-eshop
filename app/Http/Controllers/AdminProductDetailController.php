<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class AdminProductDetailController extends Controller
{
    public function index($product_id){
        $product = Product::with(['photo','color','category','inventory'])
            ->where('id','=',$product_id)->first();
        return view('admin_product_detail')
            ->with('product',$product);
    }

    public function create($product_id, Request $request){

        $product = Product::where('id','=',$product_id)->first();
        if (request('m') == 'photo_dump') {
            $photo_path = request('photo_path');

            unlink(realpath($photo_path));

            Photo::where('path','=',$photo_path)->where('path','=', $photo_path)->first()->delete();
        }
        elseif(request('m') == 'remove_product'){
            $photo_list= Photo::where('product_id','=',$product_id)->get();
            foreach($photo_list as $photo) {
                $photo_path = Photo::where('path','=',$photo->path)->first()->path;
                unlink(realpath($photo_path));
            }
            $product->delete();
            return redirect()->route('admin_product_list_view');
        }
        elseif (request('m') == 'product_update'){
            $product_name = request('admin_product_name');
            $product_information = request('admin_product_information');
            $product_price = request('admin_product_price');
            $product_size = request('admin_size');
            $product_quantity = request('admin_product_quantity');

            $product->name= $product_name;
            $product->price = $product_price;
            $product->information = $product_information;
            $product->save();

            $inventory_product =Inventory::where('product_id','=',$product_id)->where('size','ilike',$product_size);
            if($inventory_product->count()==0){
                $inventory  = new Inventory;
                $inventory->size = $product_size;
                $inventory->quantity = $product_quantity;
                $inventory->product_id = $product_id;
                $inventory->save();
            }
            else{
                $inventory_product = $inventory_product->first();
                $inventory_product->quantity = $product_quantity;
                $inventory_product->save();
            }

        }
        elseif (request('m') == 'upload_photo'){
            if (is_uploaded_file($_FILES['photo_selector']['tmp_name']))
            {
                if(empty($_FILES['photo_selector']['name'])) {
                    return back();
                }
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["photo_selector"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    return back();
                }

                $upload_file_name = $_FILES['photo_selector']['name'];
                $hashed_name = md5($upload_file_name.time()).'.'.$imageFileType;

                $upload_path = 'images/'.$hashed_name;
                $dest=getcwd().'\images\\'.$hashed_name;

                if(move_uploaded_file($_FILES['photo_selector']['tmp_name'], $dest)){
                    $new_photo = new Photo;
                    $new_photo->name = $upload_file_name;
                    $new_photo->path = $upload_path;
                    $new_photo->product_id = $product_id;
                    $new_photo->save();
                }
            }
        }
        return back();
    }
}
