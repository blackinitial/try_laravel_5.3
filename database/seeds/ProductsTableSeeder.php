<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$products = ["Accord", "Civic", "City", "CR-V", "Jazz", "Freed", "Mobilio"];
    	$descriptions = ["Manual Handling", "Auto Handling"];

    	foreach ($products as $products) {
    	
        	DB::insert('insert into products (name, description, price, stock) values (:name, :description, :price, :stock)', [
					'name' => $products,
					'description' => $descriptions[rand(0,1)],
					'price' => rand(100,800) * 1000000,
					'stock' => rand(10,40)
			]);
        }

		$this->command->info('Berhasil menambah mobil !');
    }
}
