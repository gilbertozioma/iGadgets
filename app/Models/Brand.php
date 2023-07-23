<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'brands';

    // Specify the fillable attributes that can be mass-assigned
    protected $fillable = [
        'name',
        'slug',
        'status',
        'category_id'
    ];

    // Define a relationship between Brand and Category models
    public function category()
    {
        // A Brand belongs to a Category based on the 'category_id' foreign key
        // and the 'id' primary key in the Category model
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
