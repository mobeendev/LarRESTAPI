<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(ProductsTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(CategoryProductTableSeeder::class);
        $this->call(UserSeeder::class);
    }

}
