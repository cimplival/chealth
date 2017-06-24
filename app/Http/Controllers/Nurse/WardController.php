<?php

namespace App\Http\Controllers\Nurse;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Ward;
use Session;

class WardController extends Controller
{
	//Get Wards Page
	public function getWards()
	{
	  $wards = Ward::paginate(10);
	  return view('templates.nurse.wards', compact('wards'));
	}

	public function createWard(Request $request)
	{
		$this->validate($request, [
                'ward_name'            => 'required|max:265',
                'ward_capacity'        => 'required|numeric',
                'ward_notes'           => 'required|max:1000',
                'ward_status'          => 'required'
        ]);

		$user = $request->user()->id;

        $ward_status = $request->input('ward_status');

        //ward status 0=closed, 1=open , 2 = full
        if($ward_status==0){
            $ward_status = 0;
        } elseif($ward_status==1) {
            $ward_status = 1;
        } else {
            $ward_status = 2;
        }

        Ward::create([
                'ward_name'            => $request->input('ward_name'),
                'ward_capacity'        => $request->input('ward_capacity'),
                'ward_notes'           => $request->input('ward_notes'),
                'ward_status'          => $ward_status,
                'from_user'            => $user
        ]);

    	return redirect()->route('get-wards')->with('info', 'The Ward has been created successfully.');
	}

	public function updateWard($id, Request $request)
    {
    	$this->validate($request, [
                'ward_name'            => 'required|max:265',
                'ward_capacity'        => 'required|numeric',
                'ward_notes'           => 'required|max:1000',
                'ward_status'          => 'required'
        ]);

        $ward = Ward::where('id', $id)->first();
        $input = $request->all();
        $ward->fill($input)->save();

        return redirect()->route('get-wards')->with('info-wards', 'The ward has been updated successfully.'); 
    }

    public function deleteWard($id)
    {   
        $ward = Ward::find($id);
        $ward->delete();

        return redirect()->route('get-wards')->with('info-wards', 'You have deleted successfully the ward.');
    }

    public function searchWards(Request $request){

        $query = $request->input('search');
        $wards = Ward::where('id', 'LIKE', '%' . $query . '%')
                                   	->orWhere('ward_name', 'LIKE', '%' . $query . '%')
                                    ->orWhere('ward_notes', 'LIKE', '%' . $query . '%')
                                    ->orWhere('from_user', 'LIKE', '%' . $query . '%')
                                    ->orWhere('created_at', 'LIKE', '%' . $query . '%')
                                    ->orWhere('updated_at', 'LIKE', '%' . $query . '%')
                                    ->paginate(10);

        Session::flash('info-wards', 'There were ' . count($wards) .' search results for "'. $query . '".' );

        return view('templates.nurse.wards', compact('wards'));
    }
}
