<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BorrowLog extends Model
{
    protected $fillable = ['id','code_id', 'user_id', 'is_returned','created_at'];


    public function book()
    {
        return $this->belongsTo('App\Book');
    }

    public function code()
    {
        return $this->belongsTo('App\Code');
    }

    public function denda()
    {
        return $this->belongsTo('App\Denda');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    protected $casts = [
    'is_returned' => 'boolean'
    ];

    public function scopeReturned($query)
    {
    	return $query->where('is_returned', 1);
    }

    public function scopeBorrowed($query)
    {
    	return $query->where('is_returned', 0);
    }

    public function getPinjamAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    public function getKembaliAttribute()
    {
        return $this->created_at->addDays($this->denda->jth_tempo)->format('d F Y');
    }

    public function getJosAttribute()
    {
        return $this->created_at->addDays($this->denda->jth_tempo);
    }

    public function getBanyakDendaAttribute()
    {
        if(Carbon::now()->gt($this->jos))
            return ($this->jos->diffinDays(Carbon::now()))*$this->denda->denda;
        else {
            return '-';
            }
    }
}