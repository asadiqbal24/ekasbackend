<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class , 'category');
    }
}
