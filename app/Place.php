<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Place extends Model
{
    protected $fillable = ['name'];
    
    public function books()
	{
		return $this->hasMany('App\Book');
	}
	    public static function boot()
    {
    	parent::boot();

    	self::deleting(function($place){
    		if ($place->books->count()>0){
    			//menyimpan pesan error
    			$html = 'Rak tidak bisa dihapus karena terdapat buku : ';
    			$html .='<ul>';
    			foreach ($place->books as $book){
    				$html .= "<li>$book->title</li>";
    			}
    			$html .='</ul>';

    			// Session::flash("flash_notification",[
    			// 	"level"=>"danger",
    			// 	"message"=>$html
    			// 	]);

    			//membatalkan proses penghapusan
    			return false;
    		}
    		});
    } 
}
