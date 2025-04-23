<?php

namespace App\Http\Controllers;

use App\Projection;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
	//todo test me
	public function index()
	{
		$reservations = auth()->user()->reservations;

		return view('reservations', compact('reservations'));
	}

	//todo add test
	public function store(Projection $projection)
	{
		request()->validate([
			'selectedSeats'=>'required|array|min:1|max:'.Reservation::MAX_SEATS_PER_USER_FOR_RESERVATION,
		]);

		DB::beginTransaction();
		try{
			$projection->makeNewReservationForNormalUser(request()->selectedSeats);
		} catch(\Exception $e) {
            // DB::rollback();

			return json_response(
				422,
				'Validation error',
				($e->getCode() == 1337) ? $e->getMessage(): 'Unexpected Error'
			);
		}

		flash(
			sprintf('Successful reservation for %s, movie: %s', $projection->movie->name, $projection->start),
			'success'
		);
		
		DB::commit();
		return json_response(200,'Successful Operation');
	}

}
