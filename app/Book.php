<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;


class Book extends Model
{

    //
    protected $fillable = ['title', 'author_id', 'category_id', 'place_id', 'synopsis', 'editions', 'cover'];

    public function author()
    {
    	return $this->belongsTo('App\Author');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }


    public function place()
    {
        return $this->belongsTo('App\Place');
    }
    public function code()
    {
        return $this->hasMany('App\Code');
    }
    public function borrowLogs() 
    { 
        return $this->hasManyThrough( 'App\BorrowLog','App\Code'); 
    }


    public function getAmountAttribute()
    {
        return $this->code()->count();
    }


    public function getStockAttribute()
    {
    	$borrowed = $this->borrowLogs()->borrowed()->count();
        $amount = $this->code()->count();
    	$stock = $amount-$borrowed;
    	return $stock;
    }

    public static function boot()
    {
     
    	parent::boot();

    	self::updating(function($book)
    	{
    		if ($book->amount < $book->borrowed){
    			Session::flash("flash_notification", [
    				"level"=>"danger",
    				"message"=>"Jumlah buku $book->title harus >= ". $book->borrowed
    				]);
    			return false;
    		}
    	});

    	self::deleting(function($book)
		{
			if ($book->borrowLogs()->count() > 0) {
				Session::flash("flash_notification", [
				"level"=>"danger",
				"message"=>"Buku $book->title sedang dipinjam."
			]);
			return false;
			}
		});
    }

    public function getPhotoPathAttribute() { 
        if ($this->cover != '') { 
            return url('/img/' . $this->cover); 
        } else { 
            return '/img/book.png'; 
        }
    } 
   

}

