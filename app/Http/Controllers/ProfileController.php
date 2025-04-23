<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

	public function show()
	{
		return view('profile');
	}

	public function update()
	{
		auth()->user()->name = request()->username;
		auth()->user()->save();

		flash('Success','success');	
		return back();
	}


}
