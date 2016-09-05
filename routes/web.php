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


/*---------------LATIH ROUTING-----------------------*/
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
/*---------------LATIH ROUTING---------------------------*/

/*-----------contoh dari Mas Zezen------------------------------*/
//Route::get('/', 'indexcontroller@index');

Route::get('/getuser', 'indexcontroller@getuser');
/*--------------------------------------------*/


/*----------------MEMORY TEST---------------------------------*/
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

Route::get('/list-stock-chunk', function() {
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

/*-----------------MEMORY TEST--------------------------------*/


/*-------------ROUTING TRANSACTION OTOMATIS---------------------*/

Route::get('/order-product', function() {
	//mulai transaksi
	// DB::transaction(function() {
		//buat record di table orders
		$order_id = DB::table('orders')->insertGetId(['customer_id' => 1]);

		//tambah record baru di order_products
		DB::table('orders_products')->insert(['order_id' => $order_id, 'product_id' => 5]); //contoh beli product id 5

		//bayar order -> berarti field paid_at di table orders kita isi
		DB::table('orders')->where('id', $order_id)->update(); 

		//kurangi stock 1 buah
		DB::table('products')->decrement('stock');

	// });

	echo "Berhasil menjual " . DB::table('products')->find(5)->name . '<br>';
	echo "Stock Terkini : " . DB::table('products')->find(5)->stock;
});
/*----------------ROUTING TRANSACTION----------------------------*/

/*--------------LOGGING--------------------------*/

Route::get('/customers', function() {
	DB::connection()->enableQueryLog();

	$products = DB::table('products')->get();
	$products = DB::table('customers')->whereIn('id', [1,4,5])->select(['name', 'phone'])->get();
	$customers = DB::table('customers')->leftJoin('membership_types', 'customers.membership_type_id', '=', 'membership_type_id')->get();

	/*var_dump*/dd(DB::getQueryLog());
});
/*--------------LOGGING--------------------------*/

/*------method findOrFail--error dg message-----*/

Route::get('/customer/{id}', function($id) {
	try {
		$customer = App\Models\Customer::findOrFail($id);
		return $customer;

	}
	catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		return "Ooops... Customer tidak ditemukan !!";
	}
});
/*---------------*/

/*------------*/
Route::get('/products', function () {
	return App\Models\Product::all();
});
Route::get('/product/{id}', function($id) {
	return App\Models\Product::find($id);
});