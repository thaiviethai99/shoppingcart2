<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductTableSeeder::class);
    }
}

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name'  => 'PHP Can Ban',
                'description'=>'php',
                'price'  => 100000,
            ],
            [
                'name'  => 'Node js',
                'description'=>'nodejs',
                'price'  => 200000,
            ]]
        );
    }
}
