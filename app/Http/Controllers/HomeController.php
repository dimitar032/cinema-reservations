<?php

namespace App\Http\Controllers;

use App\Building;
use App\Movie;
use App\Projection;
use App\Reservation;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    //todo remove me some day
    public function fakeSocialLogin()
    {
        Auth::loginUsingId(User::first()->id);
        return $this->getRedirectAccordingRole();
    }
        

    public function getMovieProjectionApp()
    {
        // todo find building some how  
        if(!$building = Building::whereHas('movies')->first()){
            $building = Building::first();
        }
        return view('dashboard.movies',compact('building'));
    }
            

    public function getRedirectAccordingRole(){
        $user = auth()->user();
        $user->setFavoriteBuilding();

        if($user->hasRole('manager')){
            return redirect()->route('building.index');
        }elseif($user->hasRole('employee')){
            $building = $user->employee_buildings()->first();
            return redirect()->route('building.employee-work.show',$building);
        }else{ //normal user
            // todo find building some how 
            if(!$building = Building::whereHas('movies')->first()){
                $building = Building::first();
            }
            return view('dashboard.movies',compact('building'));
        }
    }   

    //ajax call
    // todo add test to this method
    public function getMoviesAndProjectionForBuilding(Building $building){
        $data['building'] = $building;
        $data['building_movies'] = $building->movies; //todo get last 20 i guess and with or without projections..  
        // $data['buildings'] =  Building::all();
        $data['buildings'] = Building::all()->load('city')->groupBy('city_id');
        return $data;
    }

    // todo add test to this method
    public function getProjectionForMovieInBuilding(Building $building, Movie $movie){
        return $building->getAvailableProjectionForMovie($movie);
    }

    // todo add test to this method
    public function getProjectionSeats(Projection $projection){
        return $projection->getAllSeat();
    }

            
    //todo Employee Folder ApiController
    //todo test me
    public function getEmployeeProjectionsInBuildingForToday(Building $building)
    {
        return $building->getProjectionsForTodayJson();
    }
            
}
