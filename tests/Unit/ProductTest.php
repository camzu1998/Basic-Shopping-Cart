<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A cart create test
     *
     * @return void
     */
    public function test_create_product()
    {
        //Creating cart
        $product = Product::factory()->create();

        //Check if cart created
        $this->assertIsObject($product);
        $this->assertModelExists($product);
    }

    /**
     * A cart change test
     *
     * @return void
     */
    public function test_update_product()
    {
        //Creating cart
        $product = Product::factory()->create();
        //Change cart date
        $product->name = 'name-test';
        $product->save();

        //Check if changed cart is in database
        $this->assertDatabaseHas('products', [
            'name' => 'name-test',
        ]);
    }

    /**
     * A delete cart test
     *
     * @return void
     */
    public function test_delete_product()
    {
        //Creating task
        $product = Product::factory()->create();
        //Delete task
        $product->delete();

        //Check if cart is deleted
        $this->assertModelMissing($product);
    }
}
