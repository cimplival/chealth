<?php

namespace App\Http\Controllers\Medical;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Immunization;
use App\Examination;
use Session;
use Carbon\Carbon;
use App\Activity;

class ImmunizationController extends Controller
{
    public function addImmunization(Request $request)
    {
    	$this->validate($request, [
                'vaccine_name'      => 'required|max:265',
                'vaccine_date'      => 'required|max:20'
        ]);

        $vaccine_date = $request->input('vaccine_date');
        $vaccine_date = new carbon($vaccine_date);

        $examination_id = $request->input('examination_id');
        $examination    = Examination::where('id', $examination_id)->first();
        $from_user      = $request->user()->id;

        Immunization::create([
                'appointment_id'    => $examination->appointment_id,
                'on_patient'        => $examination->on_patient,
                'vaccine'           => $request->input('vaccine_name'),
                'date_administered' => $vaccine_date,
                'from_user'         => $from_user
        ]);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " added an immunization for the patient ". $examination->patient->first_name. " " . $examination->patient->middle_name. " " . $examination->patient->last_name . " of ". $examination->patient->med_id.".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

    	return redirect()->route('medical-profile')->with('success', 'The patient\'s immunization has been added successfully.');
    }
}
