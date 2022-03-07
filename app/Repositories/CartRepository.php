<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;

use Illuminate\Http\Request;

class CartRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new Cart();
    }

    /**
     * Find a cart
     *
     * @param mixed $session
     * @return App\Models\Cart
     */
    public function create_cart(mixed $session)
    {
        $cart = $this->model->factory()->create();
        $session->put('secure_key', $cart->secure_key);
        return $cart;
    }

    /**
     * Find a cart
     *
     * @param mixed $session
     * @return App\Models\Cart
     */
    public function get_cart(mixed $session)
    {
        $secure_key = $session->get('secure_key');
        $cart = $this->model->secureKey($secure_key)->first();

        if(empty($cart->created_at))
        {
            $session->forget('secure_key');
//            abort(404, 'Cart not found.');
            $cart = $this->create_cart($session);
        }

        return $cart;
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

    /**
     * Add a product to cart
     *
     * @param array $data
     * @param mixed $session
     * @param App\Models\Product $product
     * @return App\Models\CartProduct
     */
    public function add_product(array $data, Product $product, mixed $session)
    {
        $qty = 0;

        if( $session->missing('secure_key') ){
            $cart = $this->create_cart($session);
        }else{
            $cart = $this->get_cart($session);
        }

        $cart_product = CartProduct::cart($cart->id)->product($product->id)->first();
        if(!empty($cart_product->id))
            return $this->update_product($data, $product, $session);

        $cart_products = CartProduct::cart($cart->id)->get();
        foreach($cart_products as $cart_product){
            $qty += $cart_product->qty;
        }

        if($qty == 3 || $qty+$data['qty'] > 3)
            abort(400, 'Qty would be over limit');

        $cart->updated_at = date('Y-m-d H:i:s');
        $cart->save();

        return CartProduct::factory()->create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'qty' => $data['qty']
        ]);
    }
    /**
     * Update a product qty in cart
     *
     * @param array $data
     * @param mixed $session
     * @param App\Models\Product $product
     * @return App\Models\CartProduct
     */
    public function update_product(array $data, Product $product, mixed $session)
    {
        $qty = 0;
        if( $session->missing('secure_key') ){
            abort(400, 'Cart is not created. Add previous some products.');
        }else{
            $cart = $this->get_cart($session);
        }

        $cart_products = CartProduct::cart($cart->id)->get();
        foreach($cart_products as $cart_product){
            $qty += $cart_product->qty;
        }

        if($qty == 3 || $qty+$data['qty'] > 3)
            abort(400, 'Qty would be over limit');

        $cart_product = CartProduct::cart($cart->id)->product($product->id)->first();
        $cart_product->qty += $data['qty'];
        $cart_product->save();

        $cart->updated_at = date('Y-m-d H:i:s');
        $cart->save();

        return $cart_product;
    }
}
