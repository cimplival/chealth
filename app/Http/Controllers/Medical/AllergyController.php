<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Allergy;
use App\Examination;
use Carbon\Carbon;
use App\Activity;

class AllergyController extends Controller
{
    public function addAllergy(Request $request)
    {
    	$this->validate($request, [
                'allergy_name'      => 'required|max:255',
                'allergy_severity'  => 'required|max:255',
                'allergy_date'      => 'required|max:20',
                'allergy_status'    => 'required|max:5',
                'allergy_reactions' => 'required|max:255',
                'allergy_notes'     => 'required|max:2000'
        ]);

        $allergy_date = $request->input('allergy_date');
        $allergy_date = new carbon($allergy_date);

        $examination_id = $request->input('examination_id');
        $examination    = Examination::where('id', $examination_id)->first();
        $from_user      = $request->user()->id;
        
        Allergy::create([
                'appointment_id'    => $examination->appointment_id,
                'on_patient'        => $examination->on_patient,
                'allergy'           => $request->input('allergy_name'),
                'severity'          => $request->input('allergy_severity'),
                'observation_date'  => $allergy_date,
                'status'            => $request->input('allergy_status'),
                'reactions'         => $request->input('allergy_reactions'),
                'notes'             => $request->input('allergy_notes'),
                'from_user'         => $from_user
        ]);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " added an allergy for the patient ". $examination->patient->first_name. " " . $examination->patient->middle_name. " " . $examination->patient->last_name . " of ". $examination->patient->med_id.".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

    	return redirect()->route('medical-profile')->with('success', 'The patient\'s allergy has been added successfully.');; 
    }
}
