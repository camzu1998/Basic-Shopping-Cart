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
}
