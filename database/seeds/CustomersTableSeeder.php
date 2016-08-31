<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Script Pertama contoh faker customers
        /*$faker = Faker::create();

        foreach ( range(1,10) as $index ) {
        	DB::insert('insert into customers (name, phone, address) value ( :name, :phone, :address)', [
        			'name' => $faker->name,
        			'phone' => $faker->phoneNumber,
        			'address' => $faker->address
        			]);
        }

        $this->command->info('Berhasil menambah customers data faker !!');*/


        $faker = Faker::create();
        $membership_type_id = [null, 1, 2];

        foreach ( range(1,10) as $index ) {
            DB::table('customers')->insert([
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'membership_type_id' => $membership_type_id[rand(0,2)]
                
                ]);
        }

        $this->command->info('Berhasil menambah customers data faker !!');

    }
}
