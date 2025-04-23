<?php

namespace App\Http\Controllers;

use App\Building;
use App\Room;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Building $building, Room $room)
    {
        //todo auth
        //todo test
//        remember rows for for?
        $room->load('seats');
        return view('seats', compact('room'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\odel $odel
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building, Room $room)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\odel $odel
     * @return \Illuminate\Http\Response
     */
    public function edit(odel $odel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\odel $odel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, odel $odel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\odel $odel
     * @return \Illuminate\Http\Response
     */
    public function destroy(odel $odel)
    {
        //
    }
}
