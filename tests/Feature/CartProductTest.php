<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartProductTest extends TestCase
{
    use RefreshDatabase;

    protected $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = Product::factory()->create();
    }

    /**
     * An adding first product to cart
     *
     * @return void
     */
    public function test_add_product_to_cart()
    {
        $response = $this->post('/cart/'.$this->product->id, []);
        $response->assertSessionHasErrors(['qty']);

        $response = $this->post('/cart/'.$this->product->id, [
            'qty'  => 5,
        ]);
        $response->assertSessionHas('status');
    }
    /**
     * An update cart product qty test
     *
     * @return void
     */
    public function test_update_cart_product_qty()
    {
        $response = $this->post('/cart/'.$this->product->id, [
            'qty'  => 2,
        ]);
        $response->assertSessionHas('status');
        $response->assertSessionHas('secure_key');

        $response = $this->put('/cart/'.$this->product->id, [
            'qty'  => 2,
        ]);
        $response->assertRedirect('/cart');
        $response->assertSessionHas('status');
    }
    /**
     * A delete cart product form cart
     *
     * @return void
     */
    public function test_delete_cart_product_from_cart()
    {
        //Creating cart
        $cart = Cart::factory()->create();
        //Creating cart product
        $cart_product = CartProduct::factory()->create([
            'cart_id' => $cart->id,
            'product_id' => $this->product->id,
            'qty' => 1
        ]);

        //Delete cart product
        $response = $this->delete('/cart/'.$cart_product->id);
        $response->assertRedirect('/cart');
        $response->assertSessionHas('status');
    }
}
