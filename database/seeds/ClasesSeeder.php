<?php

use Illuminate\Database\Seeder;
use App\Clase;
class ClasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clases = new Clase();
        $clases->id = '1';
    	$clases->name = 'I';
    	$clases->save();

    	$clases = new Clase();
        $clases->id = '2';
    	$clases->name = 'II';
    	$clases->save();

    	$clases = new Clase();
        $clases->id = '3';
    	$clases->name = 'III';
    	$clases->save();

    	$clases = new Clase();
        $clases->id = '4';
    	$clases->name = 'IV';
    	$clases->save();

    	$clases = new Clase();
        $clases->id = '5';
    	$clases->name = 'V';
    	$clases->save();

    	$clases = new Clase();
        $clases->id = '6';
    	$clases->name = 'VI';
    	$clases->save();
    }
}
