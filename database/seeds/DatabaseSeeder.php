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
        // $this->call(UsersTableSeeder::class);
        $this->call(ClasesSeeder::class);    
        $this->call(UsersSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(PlacesSeeder::class);
        $this->call(DendasSeeder::class);  
        $this->call(BooksSeeder::class); 
    }
}
