<?php

use Illuminate\Database\Seeder;
use App\Denda;
class DendasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $denda = new Denda();
        $denda->id = '1';
    	$denda->denda = '100';
    	$denda->jth_tempo= '3';
    	$denda->save();

    }
}
