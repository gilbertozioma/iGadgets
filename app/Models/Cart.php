<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'carts';

    // Specify the fillable attributes that can be mass-assigned
    protected $fillable = [
        'user_id',
        'product_id',
        'product_color_id',
        'quantity'
    ];

    /**
     * Get the user that owns the Cart (relation with Product model)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        // A Cart belongs to a Product based on the 'product_id' foreign key
        // and the 'id' primary key in the Product model
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * Get the product color that belongs to the Cart (relation with ProductColor model)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productColor(): BelongsTo
    {
        // A Cart belongs to a ProductColor based on the 'product_color_id' foreign key
        // and the 'id' primary key in the ProductColor model
        return $this->belongsTo(ProductColor::class, 'product_color_id', 'id');
    }
}
