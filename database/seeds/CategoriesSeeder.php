<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fiksi = Category::create(['name' => 'Fiksi']);
        $fiksi = Category::create(['name' => 'Agama']);
        $fiksi = Category::create(['name' => 'IPA']);
        $fiksi = Category::create(['name' => 'Matematika']);
        $fiksi = Category::create(['name' => 'Komputer']);
    }
}
