<?php

use Illuminate\Database\Seeder;
use App\Place;

class PlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $places = new Place();
        $places->id = '1';
    	$places->name = 'A-D';
    	$places->save();

    	$places = new Place();
        $places->id = '2';
    	$places->name = 'E-H';
    	$places->save();

    	$places = new Place();
        $places->id = '3';
    	$places->name = 'I-L';
    	$places->save();

    	$places = new Place();
        $places->id = '4';
    	$places->name = 'M-P';
    	$places->save();

    	$places = new Place();
        $places->id = '5';
    	$places->name = 'Q-T';
    	$places->save();

    	$places = new Place();
        $places->id = '6';
    	$places->name = 'U-X';
    	$places->save();

    	$places = new Place();
        $places->id = '7';
    	$places->name = 'Y-Z';
    	$places->save();
    }
}
