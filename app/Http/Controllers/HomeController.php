<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\CartItem;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request) {
        // $request->session()->forget('cart');
        $prods = Product::all();
        $latestProds = Product::all();
        return view('home')->with([
            'prods' => $prods,
            'latestProds' => $latestProds,
        ]);
    }

    public function productDetails($slug) {
        $prod = Product::where('slug', '=', $slug)->first();
        return view('product_details')->with([
            'prod' => $prod,
        ]);
    }

    public function addCart(Request $request) {
        $id = $request->id;
        $quantity = $request->quantity;
        $prod = Product::find($id);
        if ($prod != null) {
            $cart = [];
            if ($request->session()->get('cart') != null) {
                $cart = $request->session()->get('cart');
            }
            if (array_key_exists($id, $cart)) {
                $cart[$id]->incrementQuantity($quantity);
            } else {
                $item = new CartItem($prod, $quantity);
                $cart[$id] = $item;
            }
            $request->session()->put('cart', $cart);
        }
    }

    public function viewCart() {
        return view('view_cart');
    }
}
