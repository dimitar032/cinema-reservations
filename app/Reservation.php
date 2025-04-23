<?php

namespace App;

use App\Projection;
use App\ReservationType;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
	const MAX_SEATS_PER_USER_FOR_RESERVATION = 4;

	const NEW_TYPE = 1;
	const USED_TYPE = 2;
	const CANCELED_TYPE = 3;
	const DIRECT_SELL = 4;
	
	public function projection()
	{
		return $this->belongsTo(Projection::class);
	}
	
	public function type()
	{
		return $this->belongsTo(ReservationType::class);
	}
	

}
