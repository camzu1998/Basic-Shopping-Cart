<?php

namespace Tests\Feature;

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
        $response->assertSessionHasErrors(['qty']);

        $response = $this->post('/cart/'.$this->product->id, [
            'qty'  => 2,
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
        $response->assertStatus(400)->assertSee('Qty');

        $response = $this->put('/cart/'.$this->product->id, [
            'qty'  => 1,
        ]);
        $response->assertRedirect('/cart');
        $response->assertSessionHas('status');
    }
//    /**
//     * A delete cart product form cart
//     *
//     * @return void
//     */
//    public function test_update_product_form()
//    {
//        $response = $this->get('/product/99/edit');
//        $response->assertStatus(404);
//
//        $product = Product::factory()->create();
//        $response = $this->get('/product/'.$product->id.'/edit');
//        $response->assertStatus(200)->assertSee($product->name);
//
//        $response = $this->put('/product/'.$product->id, [
//            'name' => 'UpdateNameTest',
//            'price' => 99.99
//        ]);
//        $response->assertStatus(201);
//    }
}
