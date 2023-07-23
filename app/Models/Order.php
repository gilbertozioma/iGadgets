<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'orders';

    // Specify the fillable attributes that can be mass-assigned
    protected $fillable = [
        'user_id',
        'tracking_no',
        'fullname',
        'email',
        'phone',
        'pincode',
        'address',
        'status_message',
        'payment_mode',
        'payment_id'
    ];

    /**
     * Get all of the orderItems for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems(): HasMany
    {
        // An Order has many OrderItems based on the 'order_id' foreign key
        // and the 'id' primary key in the OrderItem model
        return $this->hasMany(Orderitem::class, 'order_id', 'id');
    }
}
