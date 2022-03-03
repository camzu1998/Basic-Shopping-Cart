<?php

namespace Tests\Unit;

use App\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A cart create test
     *
     * @return void
     */
    public function test_create_cart()
    {
        //Creating cart
        $cart = Cart::create();

        //Check if cart created
        $this->assertIsObject($cart);
        $this->assertModelExists($cart);
    }

    /**
     * A cart change test
     *
     * @return void
     */
    public function test_update_cart()
    {
        //Creating cart
        $cart = Cart::factory()->create();
        //Change cart date
        $cart->updated_at = '2022-02-22 20:22:02';
        $cart->save();

        //Check if changed cart is in database
        $this->assertDatabaseHas('carts', [
            'updated_at' => '2022-02-22 20:22:02',
        ]);
    }

    /**
     * A delete cart test
     *
     * @return void
     */
    public function test_delete_user()
    {
        //Creating task
        $cart = Cart::factory()->create();
        //Delete task
        $cart->delete();

        //Check if cart is deleted
        $this->assertModelMissing($cart);
    }
}
