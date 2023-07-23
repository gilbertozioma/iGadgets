<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'product_images';

    // Specify the fillable attributes that can be mass-assigned
    protected $fillable = [
        'product_id',
        'image'
    ];
}
