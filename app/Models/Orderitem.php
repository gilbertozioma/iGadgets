<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orderitem extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'order_items';

    // Specify the fillable attributes that can be mass-assigned
    protected $fillable = [
        'order_id',
        'product_id',
        'product_color_id',
        'quantity',
        'price'
    ];

    /**
     * Get the product that owns the Orderitem (relation with Product model)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        // An Orderitem belongs to a Product based on the 'product_id' foreign key
        // and the 'id' primary key in the Product model
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * Get the product color that owns the Orderitem (relation with ProductColor model)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productColor(): BelongsTo
    {
        // An Orderitem belongs to a ProductColor based on the 'product_color_id' foreign key
        // and the 'id' primary key in the ProductColor model
        return $this->belongsTo(ProductColor::class, 'product_color_id', 'id');
    }
}
