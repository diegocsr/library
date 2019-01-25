<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
	protected $fillable = ['name'];

	    public function user()
	{
		return $this->hasMany('App\User');
	}


	    public function borrow()
    {
	return $this->hasManyThrough('App\BorrowLog', 'App\User')->where('is_returned',0);    	
    }
	    
	    public function retur()
    {
	return $this->hasManyThrough('App\BorrowLog', 'App\User')->where('is_returned',1);    	
    }
	   //  public static function boot()
    // {
    // 	parent::boot();

    // 	self::deleting(function($clase){
    // 		if ($clase->users->count()>0){
    // 			//menyimpan pesan error
    // 			$html = 'Kelas tidak bisa dihapus karena masih memiliki member : ';
    // 			$html .='<ul>';
    // 			foreach ($clase->users as $user){
    // 				$html .= "<li>$user->name</li>";
    // 			}
    // 			$html .='</ul>';

    // 			Session::flash("flash_notification",[
    // 				"level"=>"danger",
    // 				"message"=>$html
    // 				]);

    // 			//membatalkan proses penghapusan
    // 			return false;
    // 		}
    // 		});
    // } 
}
