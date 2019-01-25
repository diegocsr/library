<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class Code extends Model
{
	protected $fillable = ['id','code_book', 'book_id'];

	public function book()
    {
    	return $this->belongsTo('App\Book');
    }

        public function borrowLogs()
    {
    	return $this->hasMany('App\BorrowLog');
    }

		public function getBorrowedAttribute()
	{
		return $this->borrowLogs()->borrowed()->get();
	}

	public function getBaAttribute()
	{
		$a = $this->borrowLogs()->borrowed()->get();
		$ba = $a-1;
		return $ba;
	}

	    public static function boot()
    {
        self::deleting(function($code)
        {
            if ($code->borrowLogs()->count() > 0) {
                Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Kode buku $code->code_book sedang dipinjam."
            ]);
            return false;
            }
        });
    }
}
