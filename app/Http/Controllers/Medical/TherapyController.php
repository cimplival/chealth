<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Therapy;
use App\Examination;
use Auth;
use Session;
use Carbon\Carbon;
use App\Activity;

class TherapyController extends Controller
{
    public function addTherapy(Request $request)
    {

    	$this->validate($request, [
                'therapy_name'       => 'required|max:265',
                'therapy_date'       => 'required|max:20'
        ]);

        $therapy_date = $request->input('therapy_date');
        $therapy_date = new carbon($therapy_date);

        $examination_id = $request->input('examination_id');
        $examination    = Examination::where('id', $examination_id)->first();
        $from_user      = $request->user()->id;

        Therapy::create([
                'appointment_id'  => $examination->appointment_id,
                'on_patient'      => $examination->on_patient,
                'therapy_name'      => $request->input('therapy_name'),
                'date_administered' => $therapy_date,
                'from_user'         => $from_user
        ]);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " added a therapy for the patient ". $examination->patient->first_name. " " . $examination->patient->middle_name. " " . $examination->patient->last_name . " of ". $examination->patient->med_id.".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

    	return redirect()->route('medical-profile')->with('success', 'The patient\'s therapy has been added successfully.'); 
    }
}
