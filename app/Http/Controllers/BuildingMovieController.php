<?php

namespace App\Http\Controllers;

use App\Building;
use App\Movie;
use Illuminate\Http\Request;

class BuildingMovieController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Building $building)
    {
        $this->authorize('owner', $building);

        request()->validate([
            'movie_id' => 'required|exists:movies,id',
        ]);

        if ($building->movies()->where('movie_id', request()->movie_id)->exists()) {
            flash('This movies is already in that building', 'info');
            return back();
        }

        $building->movies()->attach(request()->movie_id);

        flash('Success', 'success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building, Movie $movie)
    {
        $this->authorize('owner', $building);

        $building->movies()->detach($movie);

        flash('Success', 'success');
        return back();
    }
}
