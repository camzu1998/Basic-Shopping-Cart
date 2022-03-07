<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormCartProductRequest;
use App\Models\CartProduct;
use App\Models\Product;
use App\Repositories\CartRepository;

class CartProductController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\FormCartProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormCartProductRequest $request, Product $product)
    {
        $data = $request->validated();

        $cart_product = $this->cart->add_product($data, $product, $request->session());

        return redirect('/product/'.$product->id)->with('status', 'Product added');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\FormCartProductRequest  $request
     * @param  \App\Models\Product  $cartProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FormCartProductRequest $request, Product $product)
    {
        $data = $request->validated();

        $cart_product = $this->cart->update_product($data, $product, $request->session());

        return redirect('/cart')->with('status', 'Product qty updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartProduct  $cartProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CartProduct $cartProduct)
    {
        $cartProduct->delete();

        return redirect('/cart')->with('status', 'Product deleted');
    }
}
