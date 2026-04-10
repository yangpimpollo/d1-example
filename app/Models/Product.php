<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['product_id', 'category_id', 'product_name', 'description', 'product_price'];

    public function category(){ return $this->belongsTo(Category::class, 'category_id', 'category_id'); }
    public function orderItems() { return $this->hasMany(OrderItem::class, 'product_id', 'product_id'); }
    public function orders() { return $this->belongsToMany(Order::class, 'order_items', 'product_id', 'order_id'); }
    
}
