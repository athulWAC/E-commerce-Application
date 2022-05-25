<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'category_id', 'price', 'image',
    ];



    /**
     * Get the user that owns the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * return $this->hasMany('model with class', 'foreign_key', 'local_key');
     * gets the user data which belongs to the driver
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
