<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A product create test
     *
     * @return void
     */
    public function test_create_product()
    {
        //Creating product
        $product = Product::factory()->create();

        //Check if product created
        $this->assertIsObject($product);
        $this->assertModelExists($product);
    }

    /**
     * A product change test
     *
     * @return void
     */
    public function test_update_product()
    {
        //Creating product
        $product = Product::factory()->create();
        //Change product name
        $product->name = 'name-test';
        $product->save();

        //Check if changed product is in database
        $this->assertDatabaseHas('products', [
            'name' => 'name-test',
        ]);
    }

    /**
     * A delete product test
     *
     * @return void
     */
    public function test_delete_product()
    {
        //Creating product
        $product = Product::factory()->create();
        //Delete product
        $product->delete();

        //Check if product is deleted
        $this->assertModelMissing($product);
    }
}
