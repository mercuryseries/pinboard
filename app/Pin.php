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
    protected $fillable = ['title', 'description', 'image'];

    public function owner(){
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function originalImage(){
    	return config('uploads_paths.pins.original') . $this->image;
    }

    public function mediumImage(){
    	return config('uploads_paths.pins.medium') . $this->image;
    }

    /**
     * A pin can have many favorites
     *
     */
    public function favorites()
    {
        return $this->belongsToMany('App\User', 'favorites')->withTimestamps();
    }

}
