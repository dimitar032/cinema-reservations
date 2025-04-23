<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

//todo test all heere
class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->get();

        return view('movies', compact('movies'));
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|string|min:2|max:255',
            'description' => 'required|string|min:2|max:5000',
            'premiere_date' => 'required|date_format:Y-m-d',
            'duration_in_minutes' => 'required|numeric|min:15|max:360',
        ]);
        // poster?
        Movie::create(request()->all());

        flash('Successful operation', 'success');
        return back();
    }

    public function destroy(Movie $movie)
    {
        //todo delete only if is not used somewhere..s
        $movie->delete();
     
        flash('Successful operation', 'success');
        return back();   
    }
            
}
