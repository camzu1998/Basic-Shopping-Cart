<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cart_products';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'cart_id' => false,
        'product_id' => false,
        'qty' => false,
    ];

    /**
     * Scope a query to only include defined cart.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  integer $cart_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCart($query, $cart_id)
    {
        return $query->where('cart_id', '=', $cart_id);
    }
    /**
     * Scope a query to only include defined product.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  integer $product_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeProduct($query, $product_id)
    {
        return $query->where('product_id', '=', $product_id);
    }
}
