<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
	protected $fillable = [
		'name',
        'description',
        'premiere_date',
        'duration_in_minutes',
	];
	
    protected $appends = ['poster_url'];

    public function getPosterUrlAttribute(){
    	return asset('/storage/movie_posters/'.$this->poster);
    }

}
