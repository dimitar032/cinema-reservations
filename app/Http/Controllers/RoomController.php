<?php

namespace App\Http\Controllers;

use App\Building;
use App\Room;
use App\Seat;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Building $building)
    {
        $this->authorize('owner', $building);

        $rooms = $building->rooms;
        return view('rooms', compact('building', 'rooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Building $building)
    {
        $this->authorize('owner', $building);

        request()->validate([
            'name' => 'required|min:2|max:255',
            'row' => 'required|numeric|min:1|max:19',
            'col' => 'required|numeric|min:1|max:19',
        ]);

        $room = $building->rooms()->create($request->all());
        for ($i = 0; $i < $request->row; $i++) {
            for ($j = 0; $j < $request->col; $j++) {
                $room->seats()->create([
                    'row' => $i,
                    'col' => $j,
                ]);
            }
        }

        flash('Success', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building, Room $room)
    {
        //todo add test
        $this->authorize('owner', $building);
        $currentRoom = $room;

        return view('dashboard.room', compact('building', 'currentRoom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building, Room $room)
    {
        $this->authorize('owner', $building);

        return view('room', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $building, Room $room)
    {
        $this->authorize('owner', $building);

        $room->update($request->only(['name']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building, Room $room)
    {
        $this->authorize('owner', $building);

        $room->delete();
    }

//todo test me
    public function getSeats(Building $building, Room $room){
        return $room->seats->groupBy('row');
    }

//todo test me
    public function postToggleSeatStatus(Seat $seat){
        if($seat->reservable == 1){
            $seat->reservable = 0;
        }else{
            $seat->reservable = 1;
        }

        $seat->save();
        return $seat;
    }
}
