<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Client extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        'looking' => 'array',
    ];
}
