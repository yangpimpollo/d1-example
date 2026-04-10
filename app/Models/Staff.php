<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';
    protected $primaryKey = 'dni';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'dni',
        // 'username',
        'firstname',
        'lastname',
        'email',
        'phone',
        'birthdate',
        'gender',
        'address',
        'store_id',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
