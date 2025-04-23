<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;

class BuildingEmployeeController extends Controller
{
	public function show(Building $building)
	{
		return view('employee.building', compact('building'));
	}
}
