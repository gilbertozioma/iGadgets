<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'wishlists';

    // Specify the fillable attributes that can be mass-assigned
    protected $fillable = [
        'user_id',
        'product_id'
    ];

    /**
     * Get the product that owns the Wishlist (relation with Product model)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        // A Wishlist belongs to a Product based on the 'product_id' foreign key
        // and the 'id' primary key in the Product model
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
