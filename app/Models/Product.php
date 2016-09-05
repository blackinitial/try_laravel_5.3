<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; //mendisable timestamps biar gak error ketika input
    //protected $hidden = ['description', 'stock'];

    protected $fillable = ['name', 'description', 'price', 'stock'];

    //protected $visible = ['name', 'price'];
}
