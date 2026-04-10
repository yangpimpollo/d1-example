<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = ['quantity'];
    protected $table = 'inventories';
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null;

    public function store() { return $this->belongsTo(Store::class, 'store_id', 'id'); } 
    public function product() { return $this->belongsTo(Product::class, 'product_id', 'product_id'); }
}
