<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    use HasFactory, SoftDeletes;

    /**
     * Get the user that owns the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * return $this->hasMany('model with class', 'foreign_key', 'local_key');
     * gets the user data which belongs to the driver
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }
}
