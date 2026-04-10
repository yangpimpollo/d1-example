<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';
    protected $primaryKey = 'id';
    protected $keyType = 'string'; 
    public $incrementing = false; 
    public $timestamps = false;

    protected $fillable = ['id', 'store_name', 'address', 'city', 'state'];


    
}
