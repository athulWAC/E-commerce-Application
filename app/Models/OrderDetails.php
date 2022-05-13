<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * return $this->hasMany('model with class', 'foreign_key', 'local_key');
     * gets the user data which belongs to the driver
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }


    /**
     * Get the user that owns the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * return $this->hasMany('model with class', 'foreign_key', 'local_key');
     * gets the user data which belongs to the driver
     */
    public function productdetails()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
