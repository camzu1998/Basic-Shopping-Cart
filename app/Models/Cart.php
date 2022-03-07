<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'carts';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'secure_key' => false,
    ];

    /**
     * Scope a query to only include defined secure key.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string $secure_key
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSecureKey($query, $secure_key)
    {
        return $query->where('secure_key', 'LIKE', $secure_key);
    }
}
