<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('kontak', function() {
	return '<h1>halaman kontak</h1>';
});

/**/
Route::get('welcome/{nama?}', ['as' => 'home.welcome', function($nama = 'Pengunjung') {
	return "Selamat datang " . $nama . ". Anda luar biasa! ";
}]);

Route::get('menu', function() {
	return 'Kunjungi <a href="'.route('home.welcome').'"> Halaman Welcome </a>';
});

Route::group(['prefix' => 'dashboard'], function() {

	Route::get('setting', function() {
		return 'halaman dashboard > settings';
	});

	Route::get('profile', function() {
		return 'halaman dashboard > profile';
	});

	Route::get('inbox', function() {
		return 'halaman dashboard > inbox';
	});

});

//Route::get('/', 'indexcontroller@index');

Route::get('/getuser', 'indexcontroller@getuser');

//Contoh mengukur penggunaan memory saat panggil database
Route::get('/list-stock', function() {
	$begin = memory_get_usage();

	foreach (DB::table('products')->get() as $product) {
		if ($product->stock > 20) {
			echo $product->name . ':' . $product->stock . '<br>';
		}
		# code...
	}
	echo 'Total memory usage : ' . (memory_get_usage() - $begin);
});

Route::get('list-stock-chunk', function() {
	$begin = memory_get_usage();

	DB::table('products')->chunk(100, function($products) {
		foreach ($products as $product) {
			if ($product->stock > 20) {
				echo $product->name . ':' . $product->stock . '<br>';

			}
		}
	});
	echo 'total memory usage :' . (memory_get_usage() - $begin);
});