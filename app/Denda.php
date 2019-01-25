<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Denda extends Model
{
    protected $fillable = ['denda','jth_tempo','created_at'];

    public function borrowLogs()
    {
    	return $this->hasMany('App\BorrowLog');
    }


    public function getMantapAttribute()
    {
    	$mantap = $this->jth_tempo(1);

        return $mantap;
    }

        public function getLimitAttribute()
    {
        return $limit = Carbon::parse('created_at')->addDay(3);
 
    }

    public function getStockAttribute()
    {
        $borrowed = $this->borrowLogs()->borrowed()->count();
        $stock = $this->amount - $borrowed;
        return $stock;
    }

    public function scopeJos($querry){
        return $querry->whereNotNull('jth_tempo');
    }
}
