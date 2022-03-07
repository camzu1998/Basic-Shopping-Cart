<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;

class CartTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic cart test.
     *
     * @return void
     */
    public function test_access_cart()
    {
        $response = $this->get('/cart');
        $response->assertStatus(200)->assertSee('Please');

        $cart = Cart::factory()->create();
        $product = Product::factory()->create();
        CartProduct::factory()->create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'qty' => 1
        ]);

        $response = $this->withSession(['secure_key' => $cart->secure_key])->get('/cart');
        $response->assertStatus(200)->assertSee($product->name);
    }
}
