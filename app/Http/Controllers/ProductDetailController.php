<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Symfony\Component\Console\Input\Input;
use function Symfony\Component\String\s;

class ProductDetailController extends Controller
{

    public function index()
    {
        $products = Product::with(['category', 'color', 'inventory', 'photo']);

        $filtered_product = $products
            ->clone()
            ->where('id', '=', request('id'))
            ->first();

        $productSimilarList = $products
            ->clone()
            ->where('product_category_id', '=', $filtered_product->product_category_id)
            ->where('id', '!=', $filtered_product->id)
            ->inRandomOrder()
            ->get();


        return view('product_detail')
            ->with('productPhotoList', $productSimilarList)
            ->with('product', $filtered_product);
    }

    public function add_to_cart(Request $request)
    {
        $quantity = request('quantity');
        $size = request('size');
        $user_id = Auth::id();
        $pc_product_id = request('id');

        if($user_id) {
            $products = Cart::with(['inventory'])->where('pc_size', 'ilike', $size)
                ->where('pc_product_id', '=', $pc_product_id)
                ->where('user_id', '=', $user_id)
                ->first();

            $inventory_product = Inventory::where('size', 'ilike', $size)
                ->where('product_id', '=', $pc_product_id)
                ->first();

            $product_inventory_id = $inventory_product->id;


            if ($products) {
                $products->update(['quantity' => $products->quantity + $quantity]);
                $products->save();
            } else {
                $cart = new Cart;
                $cart->quantity = $quantity;
                $cart->pc_size = $size;
                $cart->pc_product_id = $pc_product_id;
                $cart->user_id = $user_id;
                $cart->product_inventory_id = $product_inventory_id;
                $cart->save();
            }


            $inventory_quantity = $inventory_product->quantity - $quantity;
            $inventory_product->update(['quantity' => $inventory_quantity]);
            $inventory_product->save();
        }
        else{
            $products = session()->get('cart');

            $inventory_product = Inventory::where('size', 'ilike', $size)
                ->where('product_id', '=', $pc_product_id)
                ->first();

            $product_inventory_id = $inventory_product->id;

            if ($products) {
                $products_count = count($products);
                $index = null;
                for ($i = 0; $i < $products_count; $i++) {
                    $products_inventory_id = $products[$i]['product_inventory_id'];
                    if ($products_inventory_id == $product_inventory_id ) {
                        $index = $i;
                        break;
                    }
                }
                if(!is_null($index)){
                    $current_quantity = $products[$i]['quantity'];
                    $products[$i]['quantity'] = $current_quantity+$quantity;
                    session()->put('cart',$products);
                    session()->save();
                }
                else{
                    $cart_guest['quantity'] = $quantity;
                    $cart_guest['pc_size'] = $size;
                    $cart_guest['pc_product_id'] = $pc_product_id;
                    $cart_guest['product_inventory_id'] = $product_inventory_id;
                    array_push($products,$cart_guest);
                    session()->put('cart',$products);
                    session()->save();
                }

            } else {
                $cart_guest['quantity'] = $quantity;
                $cart_guest['pc_size'] = $size;
                $cart_guest['pc_product_id'] = $pc_product_id;
                $cart_guest['product_inventory_id'] = $product_inventory_id;
                session()->put('cart.0',$cart_guest);
                session()->save();
            }

        }

        return back();

    }
}
