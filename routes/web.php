<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/free', function () {
	return view('_test');
});


Auth::routes();


Route::get('/', 'HomeController@getMovieProjectionApp')->name('movie-projection-app');
Route::get('/fake-social', 'HomeController@fakeSocialLogin')->name('fake.social.login');

Route::get('api/landing/building/{building}', 'HomeController@getMoviesAndProjectionForBuilding');
Route::get('api/landing/building/{building}/movie/{movie}', 'HomeController@getProjectionForMovieInBuilding');
Route::get('api/projection/{projection}/seats', 'HomeController@getProjectionSeats');

Route::group(['middleware' => 'auth'], function () {
	Route::get('profile','ProfileController@show')->name('profile.show');
	Route::put('profile','ProfileController@update')->name('profile.update');
	
	Route::get('/landing', 'HomeController@getRedirectAccordingRole')->name('redirect-according-role');

	Route::get('/reservations', 'ReservationController@index')->name('reservations');
	Route::post('api/projection/{projection}/reserve', 'ReservationController@store');
});

Route::group(['middleware' => ['auth', 'role:employee']], function () {
	Route::get('building/{building}/work', 'BuildingEmployeeController@show')->name('building.employee-work.show');
	Route::get('api/employee/building/{building}/projections', 'HomeController@getEmployeeProjectionsInBuildingForToday');
	Route::get('api/employee/building/{building}/find-reservation', 'EmployeeController@getFindReservation');

	Route::get('api/employee/projection/{projection}/user/{user}/get-all-seats', 'EmployeeController@getProjectionAllSeatsAndUserReservedSeats');
	Route::post('api/employee/projection/{projection}/reserve', 'EmployeeController@postDirectSellReservation');

});

Route::group(['middleware' => ['auth', 'role:manager']], function () {
	// Route::get('/{selectedBuildingId?}', 'HomeController@index');
	Route::get('api/building/{building}/room/{room}/seats', 'RoomController@getSeats');
	Route::post('api/seat/{seat}', 'RoomController@postToggleSeatStatus');
	

	Route::get('api/building/{building}/latest-reservations-count', 'BuildingController@getLastDaysReservationJson');

	Route::resource('movie', 'MovieController', ['only' => ['index', 'store', 'destroy']]);

	Route::resource('building', 'BuildingController');
	Route::resource('building.room', 'RoomController', ['expect' => 'create']);
	Route::get('building/{building}/employee', 'EmployeeController@index')->name('building.employee.index');
	Route::post('building/{building}/employee', 'EmployeeController@store')->name('building.employee.store');
	Route::delete('building/{building}/employee/{employee}', 'EmployeeController@destroy')->name('building.employee.destroy');
	Route::resource('building.movie', 'BuildingMovieController', ['only' => ['store', 'destroy']]);
	Route::resource('building.room.projection', 'ProjectionController');
	Route::resource('building.room.seat', 'SeatController');
	Route::resource('building.room.projection', 'ProjectionController', ['only' => ['store','destroy']]);
});


// Route::get('/home', 'HomeController@index')->name('home');