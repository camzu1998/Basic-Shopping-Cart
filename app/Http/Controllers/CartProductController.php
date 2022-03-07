<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormCartProductRequest;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Repositories\CartRepository;

class CartProductController extends Controller
{
    /**
     * The cart repository instance.
     */
    protected $cart;

    /**
     * Create a new CartRepository instance.
     *
     * @param  \App\Repositories\CartRepository  $cart
     * @return void
     */
    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    /**
     * Store a newly created cart product in database.
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
     * Update the specified cart product in database.
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
     * Remove the specified cart product from database.
     *
     * @param  \App\Models\CartProduct  $cartProduct
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CartProduct $cartProduct)
    {
        $cart = Cart::find($cartProduct->cart_id);
        $cart->updated_at = date('Y-m-d H:i:s');
        $cart->save();

        $cartProduct->delete();

        return redirect('/cart')->with('status', 'Product deleted');
    }
}
