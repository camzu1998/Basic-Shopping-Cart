<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cart = Cart::secureKey($request->session()->get('secure_key'))->first();

        $data['cart_products'] = CartProduct::cart($cart->id)->join('products', 'cart_products.product_id', '=', 'products.id')->select('cart_products.*', 'products.name', 'products.price')->get();
        $data['total_value'] = $this->get_total_price($cart);

        return response()->view('cart', $data);
    }
    /**
     * Calculate total price of cart
     *
     * @param App\Models\Cart $cart
     * @return float|int
     */
    public function get_total_price(Cart $cart)
    {
        $total_price = 0;

        $cart_products = CartProduct::cart($cart->id)->get();
        foreach($cart_products as $cart_product)
        {
            $product = Product::find($cart_product->product_id);
            $total_price += $cart_product->qty*$product->price;
        }

        return $total_price;
    }
}
