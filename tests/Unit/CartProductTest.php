<?php

namespace Tests\Unit;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartProduct;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartProductTest extends TestCase
{
    use RefreshDatabase;

    protected $cart;
    protected $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cart = Cart::factory()->create();
        $this->product = Product::factory()->create();
    }

    /**
     * A cart product create test
     *
     * @return void
     */
    public function test_create_cart_product()
    {
        //Creating cart product
        $cart_product = CartProduct::factory()->create([
            'cart_id' => $this->cart->id,
            'product_id' => $this->product->id,
            'qty' => 1
        ]);

        //Check if cart product created
        $this->assertIsObject($cart_product);
        $this->assertModelExists($cart_product);
    }

    /**
     * A cart product change test
     *
     * @return void
     */
    public function test_update_cart_product()
    {
        //Creating cart product
        $cart_product = CartProduct::factory()->create([
            'cart_id' => $this->cart->id,
            'product_id' => $this->product->id,
            'qty' => 1
        ]);
        //Change cart product qty
        $cart_product->qty = 3;
        $cart_product->save();

        //Check if changed cart product is in database
        $this->assertDatabaseHas('cart_products', [
            'cart_id' => $this->cart->id,
            'product_id' => $this->product->id,
            'qty' => 3,
        ]);
    }

    /**
     * A delete cart product test
     *
     * @return void
     */
    public function test_delete_cart_product()
    {
        //Creating cart product
        $cart_product = CartProduct::factory()->create([
            'cart_id' => $this->cart->id,
            'product_id' => $this->product->id,
            'qty' => 1
        ]);
        //Delete cart product
        $cart_product->delete();

        //Check if cart product is deleted
        $this->assertModelMissing($cart_product);
    }
}
