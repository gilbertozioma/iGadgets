<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'user_details';

    // Specify the fillable attributes that can be mass-assigned
    protected $fillable = [
        'user_id',
        'phone',
        'pin_code',
        'address'
    ];
}
