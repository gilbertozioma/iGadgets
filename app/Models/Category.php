<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'categories';

    // Specify the fillable attributes that can be mass-assigned
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',
    ];

    /**
     * Get the products belonging to the category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        // A Category has many Products based on the 'category_id' foreign key
        // and the 'id' primary key in the Product model
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    /**
     * Get the latest 16 related products belonging to the category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function relatedProducts()
    {
        // A Category has many Products (latest 16) based on the 'category_id' foreign key
        // and the 'id' primary key in the Product model
        return $this->hasMany(Product::class, 'category_id', 'id')->latest()->take(16);
    }

    /**
     * Get the brands associated with the category, where status is 0
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function brands()
    {
        // A Category has many Brands based on the 'category_id' foreign key
        // and the 'id' primary key in the Brand model, with status = 0
        return $this->hasMany(Brand::class, 'category_id', 'id')->where('status', '0');
    }
}
