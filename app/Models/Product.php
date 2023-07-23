<?php

namespace App\Models;

use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'products';

    // Specify the fillable attributes that can be mass-assigned
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'brand',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'quantity',
        'trending',
        'featured',
        'status',
        'meta_title',
        'meta_keyword',
        'meta_description',
    ];

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        // A Product belongs to a Category based on the 'category_id' foreign key
        // and the 'id' primary key in the Category model
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get all of the productImages for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productImages()
    {
        // A Product has many ProductImages based on the 'product_id' foreign key
        // and the 'id' primary key in the ProductImage model
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    /**
     * Get all of the productColors for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productColors()
    {
        // A Product has many ProductColors based on the 'product_id' foreign key
        // and the 'id' primary key in the ProductColor model
        return $this->hasMany(ProductColor::class, 'product_id', 'id');
    }
}
