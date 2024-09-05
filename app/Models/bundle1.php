<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bundle1 extends Model
{
    use HasFactory;
    protected $table = 'bundle1';
    public $timestamps = false;
    protected $guarded = [];
}
