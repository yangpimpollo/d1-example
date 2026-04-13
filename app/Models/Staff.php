<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'staffs';
    protected $primaryKey = 'dni';
    protected $keyType = 'integer';
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
