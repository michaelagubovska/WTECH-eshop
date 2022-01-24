<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Collection\Collection;

class CartController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        if ($user_id) {
            $user = User::find($user_id);
            $cart_items_list = [];

            $cart_products = Cart::with(['inventory'])->where('user_id', '=', $user_id);

            $cart_products_id = $cart_products->clone()->get('pc_product_id');
            for ($i = 0; $i < count($cart_products_id); $i++) {
                array_push($cart_items_list, $cart_products_id[$i]->pc_product_id);
            }

            $products = Product::with(['category', 'color', 'photo'])
                ->whereIn('id', $cart_items_list);


            return view('cart')
                ->with('cart_products', $cart_products->orderBy('id')->get())
                ->with('products', $products)
                ->with('user',$user);
        }
        else{
            $cart_session = session()->get('cart');

            if($cart_session) {
                $cart_products_id = [];
                for ($i = 0; $i < count($cart_session); $i++) {
                    array_push($cart_products_id, $cart_session[$i]['pc_product_id']);
                }
                $products = Product::with(['category', 'color', 'photo'])
                    ->whereIn('id', $cart_products_id);

                return view('cart')
                    ->with('cart_products_session', $cart_session)
                    ->with('products', $products);
            }
            else {
                return view('cart')
                    ->with('cart_products_session', []);
            }
        }
    }

    public function update_quantity_delete(Request $request)
    {
        $user_id = Auth::id();
        if (request('m') == 'delete') {
            $cart_id = request('remove');
            if($user_id) {
                $cart_product = Cart::where('id', '=', $cart_id)->first();
                $inventory_id = $cart_product->product_inventory_id;
                $inventory_product = Inventory::where('id', '=', $inventory_id)->first();
                $inventory_product->quantity += $cart_product->quantity;
                $inventory_product->save();
                $cart_product->delete();
            }
            else{
                $cart_session = session()->get('cart');
                unset($cart_session[$cart_id]);
                $cart_session = array_values($cart_session);
                session()->put('cart',$cart_session);
                session()->save();
            }
        } elseif (request('m') == 'update') {
            $post = file_get_contents('php://input');
            $post_items = explode("&", $post);
            foreach ($post_items as $item) {
                $query_param = explode("=", $item);
                if ($query_param[0] == "_token" || $query_param[0] == 'm') {
                    continue;
                } elseif ($query_param[0] == "plus") {
                    $method = "plus";
                } elseif ($query_param[0] == "minus") {
                    $method = "minus";
                } else {
                    $cart_id = (int)$query_param[0];
                }
            }

            if($user_id){
                $cart_product = Cart::where('id', '=', $cart_id)->first();
                $inventory_id = $cart_product->product_inventory_id;
                $inventory_product = Inventory::where('id', '=', $inventory_id)->first();

                if ($method == "plus") {
                    $cart_product->quantity++;
                    $inventory_product->quantity--;
                } elseif ($method == "minus") {
                    $cart_product->quantity--;
                    $inventory_product->quantity++;
                }
                $cart_product->save();
                $inventory_product->save();
            }
            else{
                $cart_session = session()->get('cart');

                if ($method == "plus") {
                    $cart_session[$cart_id]['quantity']++;
                } elseif ($method == "minus") {
                    $cart_session[$cart_id]['quantity']--;
                }
                session()->put('cart',$cart_session);
                session()->save();
            }
        }
        return back();
    }


}
