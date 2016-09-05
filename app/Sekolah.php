<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah
{
    protected $nama;
    protected $alamat;

    public function __construct($nama, $alamat) {
    	$this->nama = $nama;
    	$this->alamat = $alamat;
    }
    public function __toString() {
    	return "Nama ; " . $this->nama . "\n" . "Alamat : " . $this->alamat;
    }
}
