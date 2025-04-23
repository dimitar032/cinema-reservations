<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings = auth()->user()->buildings;
        return view('buildings', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate(Building::rules());

        auth()->user()->buildings()->create(request()->all());

        flash('Success', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        //todo add test
        // $this->authorize('owner', $building);

        $building->load('rooms','movies');
        return view('dashboard.building', compact('building'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        $this->authorize('owner', $building);

        return view('building', compact('building'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Building $building)
    {
        $this->authorize('owner', $building);

        request()->validate(Building::rules());

        $building->update(request()->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        $this->authorize('owner', $building);
        
        $building->delete();
    }

    //todo tsest me
    public function getLastDaysReservationJson(Building $building)
    {
        $this->authorize('owner', $building);

        return $building->getLastDaysReservationStatusCounts();
    }
        
}
