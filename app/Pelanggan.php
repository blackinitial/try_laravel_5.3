<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'customers'; // merubah supaya model bisa panggil table dg nama beda (cz nama table hrus pke aturan plural LARAVEL) 

}
