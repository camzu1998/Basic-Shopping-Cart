<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * The user repository instance.
     */
    protected $cart;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\CartRepository  $cart
     * @return void
     */
    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cart = $this->cart->get_cart($request->session());

        $data['cart_products'] = CartProduct::cart($cart->id)->join('products', 'cart_products.product_id', '=', 'products.id')->select('cart_products.*', 'products.name', 'products.price')->get();
        $data['total_value'] = $this->cart->get_total_price($cart);

        return response()->view('cart', $data);
    }
}
