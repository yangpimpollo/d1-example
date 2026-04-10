<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['category_id', 'category_name'];

    public function products() { 
        /**
         * Argumentos:
         * 1. El modelo destino (Product)
         * 2. La llave foránea en la tabla products (category_id)
         * 3. La llave local en la tabla categories (category_id)
         */
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
