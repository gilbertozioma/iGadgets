<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'sliders';

    // Specify the fillable attributes that can be mass-assigned
    protected $fillable = [
        'title',
        'description',
        'image',
        'status'
    ];
}
