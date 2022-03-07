<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A products list view test
     *
     * @return void
     */
    public function test_show_products()
    {
        $response = $this->get('/products');
        $response->assertStatus(200)->assertSee('Sorry');

        $product = Product::factory()->create();

        $response = $this->get('/products');
        $response->assertStatus(200)->assertSee($product->name);
    }

    /**
     * A product view test
     *
     * @return void
     */
    public function test_show_product()
    {
        $response = $this->get('/product/99');
        $response->assertStatus(404);

        $product = Product::factory()->create();

        $response = $this->get('/product/'.$product->id);
        $response->assertStatus(200)->assertSee($product->name);
    }

    /**
     * A create product form test
     *
     * @return void
     */
    public function test_create_product_form()
    {
        $response = $this->get('/product');
        $response->assertStatus(200)->assertSee('Create new product');

        $response = $this->post('/product', []);
        $response->assertSessionHasErrors(['name']);

        $response = $this->post('/product', [
            'name'  => 'ProductTestName',
            'price' => 9.99
        ]);
        $response->assertStatus(201);
    }

    /**
     * An update product form test
     *
     * @return void
     */
    public function test_update_product_form()
    {
        $response = $this->get('/product/99/edit');
        $response->assertStatus(404);

        $product = Product::factory()->create();
        $response = $this->get('/product/'.$product->id.'/edit');
        $response->assertStatus(200)->assertSee($product->name);

        $response = $this->put('/product/'.$product->id, [
            'name' => 'UpdateNameTest',
            'price' => 99.99
        ]);
        $response->assertStatus(201);
    }

    /**
     * A delete product test
     *
     * @return void
     */
    public function test_delete_product()
    {
        $response = $this->delete('/product/99');
        $response->assertStatus(404);

        $product = Product::factory()->create();

        $response = $this->delete('/product/'.$product->id);
        $response->assertJson(['status' => true]);

        $response = $this->get('/products');
        $response->assertDontSee($product->name);
    }
}
