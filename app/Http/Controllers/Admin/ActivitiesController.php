<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Activity;
use Auth;
use Session;
use App\User;

class ActivitiesController extends Controller
{
	public function getActivities(Request $request)
	{	
		$user = $request->user()->id;

		if(Auth::user()->hasRole('administrator'))
		{
			$activities = Activity::paginate(10);
			$users = User::get();
			return view('templates.admin.activities', compact('activities' , 'users'));	
		} else {
			$activities   = Activity::where('from_user', $user)->paginate(10);
			return view('templates.admin.activities', compact('activities' , 'users'));	
		}
	}

	public function searchActivities(Request $request)
	{
		$query = $request->input('search');

		$users = User::get();

		$user = $request->user()->id;

		if(Auth::user()->hasRole('administrator'))
		{
			$activities = Activity::where('description', 'LIKE', '%' . $query . '%')
			->orWhereHas('users', function ($term) use($query) {
				$term->orwhere('full_name', 'LIKE', '%' . $query . '%');
			})->paginate(10);
		} else {
			$activities = Activity::where('description', 'LIKE', '%' . $query . '%')
			->orWhereHas('users', function ($term) use($query) {
				$term->orwhere('full_name', 'LIKE', '%' . $query . '%');
			})->where('from_user', $user)->paginate(10);
		}


		Session::flash('success', 'There were ' . count($activities) .' activity results for "'. $query.'".');

		return view('templates.admin.activities', compact('activities', 'users'));
	}
}
