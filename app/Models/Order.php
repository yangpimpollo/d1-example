<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'order_id',
        'order_date',
        'customer_id',
        'store_id',
        'staff_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'dni');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'dni');
    }

}
