<?php

namespace App\Http\Controllers;

use App\Building;
use App\Projection;
use App\Room;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Tests\Parser\Handler\IdentifierHandlerTest;

class ProjectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Building $building, Room $room)
    {
        $this->authorize('owner', $building);

        $projections = $room->projections;
        return view('projections', compact(['building', 'room', 'projections']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Building $building, Room $room)
    {
        $this->authorize('owner', $building);
        $request->validate(Projection::rules());

        if (! $room->isFreeForProjection($request->start)) {
            flash('There is a projection in this time period', 'danger');
            return back()->withInput();
        }

        $room->projections()->create($request->only(['start', 'movie_id']));

        flash('Success', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Model $model)
    {
        $this->authorize('');

        // return view('admin.model.show',compact('model');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $model)
    {
        $this->authorize('');

        // return view('admin.model.edit',compact('model');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Model $model)
    {
        $this->authorize('');

        // $this->validate($request, Model::$rules);
        // $model->update($request->all());

        // flash(trans('flash_msgs.successoperation'), 'success');
        // return redirect()->route('admin.model.index');
        //return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $model)
    {
        $this->authorize('');

        // $model->delete();

        // flash(trans('flash_msgs.successoperation'), 'success');
        // return redirect()->intended(route('admin.model.index'));
        //return back();
    }
}
