<?php

namespace App\Http\Controllers\Nurse;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Bed;
use App\Ward;
use Session;

class BedController extends Controller
{
  //GET HOME PAGE
  public function getBeds()
  {
      $beds = Bed::paginate(10);
      $wards = Ward::paginate(10);
      return view('templates.nurse.beds', compact('beds', 'wards'));
  }

  public function createBed(Request $request)
	{
		$this->validate($request, [
                'ward_no'              => 'required',
                'bed_no'               => 'required|max:1000',
                'bed_notes'            => 'required',
                'bed_status'           => 'required'
        ]);

		$user = $request->user()->id;

        Bed::create([
                'ward_no'              => $request->input('ward_no'),
                'bed_no'               => $request->input('bed_no'),
                'bed_notes'            => $request->input('bed_notes'),
                'bed_status'           => 0,
                'from_user'            => $user
        ]);

    	return redirect()->route('get-beds')->with('info-beds', 'The bed has been created successfully.');
	}

	public function updateBed($id, Request $request)
    {
    	$this->validate($request, [
                'ward_no'              => 'required',
                'bed_no'               => 'required|max:1000',
                'bed_notes'            => 'required',
                'bed_status'           => 'required',
                'from_user'            => 'required'
        ]);

        $bed = Bed::where('id', $id)->first();
        $input = $request->all();
        $bed->fill($input)->save();

        return redirect()->route('get-beds')->with('info-beds', 'The bed has been updated successfully.'); 
    }

    public function deleteBed($id)
    {   
        $bed = Bed::find($id);
        $bed->delete();

        return redirect()->route('get-beds')->with('info-beds', 'You have deleted successfully the bed.');
    }

    public function searchBeds(Request $request){

        $query = $request->input('search');
        $beds = Bed::where('id', 'LIKE', '%' . $query . '%')
                                   	->orWhere('ward_no', 'LIKE', '%' . $query . '%')
                                    ->orWhere('bed_no', 'LIKE', '%' . $query . '%')
                                    ->orWhere('bed_notes', 'LIKE', '%' . $query . '%')
                                    ->orWhere('bed_status', 'LIKE', '%' . $query . '%')
                                    ->orWhere('created_at', 'LIKE', '%' . $query . '%')
                                    ->orWhere('updated_at', 'LIKE', '%' . $query . '%')
                                    ->paginate(10);

        Session::flash('info-beds', 'There were ' . count($beds) .' search results for "'. $query . '".' );

        $wards = Ward::paginate(10);
        return view('templates.nurse.beds', compact('beds', 'wards'));
    }

}
