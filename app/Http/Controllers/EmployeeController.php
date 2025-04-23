<?php

namespace App\Http\Controllers;

use App\Building;
use App\Projection;
use App\Reservation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

	//todo test	 me
    public function index(Building $building)
    {
    	$employees = $building->employees;

    	return view('employees',compact('employees','building'));
    }
	
	//todo test	 me
	public function store(Building $building)
	{
		request()->validate([
			'email'=>'required|email'
		]);

		//todo add try catch
		$user = User::where('email',request()->email)->firstOrFail();
		$building->employees()->attach($user);
		if(!$user->hasRole('employee')){
	        $user->assignRole('employee');
		}

        flash('Successful operation', 'success');
        return back();
	}

	public function destroy(Building $building,User $user)
	{
		//todo remove role employee
		$building->employees()->detach($user->id);

		flash('Successful operation', 'success');
        return back();	
	}
			
	public function postDirectSellReservation(Projection $projection)
	{
		request()->validate([
			'selectedSeats'=> 'required|array|min:1|max:'.Reservation::MAX_SEATS_PER_USER_FOR_RESERVATION,
		]);

		DB::beginTransaction();
		try{
			$projection->makeDirectSellReservation(request()->selectedSeats);
		} catch(\Exception $e) {
            DB::rollback();

			return json_response(
				422,
				'Validation error',
				($e->getCode() == 1337) ? $e->getMessage(): 'Unexpected Error'
			);
		}
		DB::commit();

		flash(
			sprintf('Successful reservation for %s, movie: %s', $projection->movie->name, $projection->start),
			'success'
		);
		
		return json_response(200,'Successful Operation');
	}
					
	public function getFindReservation(Building $building)
	{
		request()->validate([
			'searchParam'=>'required|min:2',
		]);
		
		return $building->findReservationWithParam(request()->searchParam);
	}

//todo testt me
	public function getProjectionAllSeatsAndUserReservedSeats(Projection $projection, User $user){
		return $projection->getUserReservedSeats($user);
	}
			
}
