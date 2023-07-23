<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'product_colors';

    // Specify the fillable attributes that can be mass-assigned
    protected $fillable = [
        'product_id',
        'color_id',
        'quantity'
    ];

    /**
     * Get the color that owns the ProductColor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color()
    {
        // A ProductColor belongs to a Color based on the 'color_id' foreign key
        // and the 'id' primary key in the Color model
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }
}
