<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable=[
        'row',
        'col',
    ];

    public function reservations()
    {
    	return $this->hasMany(Reservation::class);
    }
    		
}
