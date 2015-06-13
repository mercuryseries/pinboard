<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
		/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description'];

    public function owner(){
    	return $this->belongsTo('App\User', 'user_id');
    }
}
