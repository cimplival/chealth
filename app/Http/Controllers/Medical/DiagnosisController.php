<?php

namespace App\Http\Controllers\Medical;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Diagnosis;
use App\Vital;
use App\Examination;
use DB;
use Input;
use Session;
use Carbon\Carbon;
use App\Activity;

class DiagnosisController extends Controller
{
    public function addDiagnosis(Request $request)
    {

    	$this->validate($request, [
                'diagnosis_title'    => 'required|max:265',
                'diagnosis_fromdate' => 'required|max:20',
                'diagnosis_todate'   => 'required|max:20',
                'diagnosis_notes'    => 'required|max:2000'
        ]);

        $from_date = $request->input('diagnosis_fromdate');
        $from_date = new carbon($from_date);

        $to_date = $request->input('diagnosis_todate');
        $to_date = new carbon($to_date);

        $examination_id = $request->input('examination_id');
        $examination    = Examination::where('id', $examination_id)->first();
        $from_user      = $request->user()->id;

        Diagnosis::create([
                'appointment_id'     => $examination->appointment_id,
                'on_patient'         => $examination->on_patient,
                'diagnosis'          => $request->input('diagnosis_title'),
                'from_date'          => $from_date,
                'to_date'            => $to_date,
                'notes'              => $request->input('diagnosis_notes'),
                'from_user'          => $from_user,
        ]);
        
        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " added a diagnosis for the patient ". $examination->patient->first_name. " " . $examination->patient->middle_name. " " . $examination->patient->last_name . " of ". $examination->patient->med_id.".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

    	return redirect()->route('medical-profile')->with('success', 'The patient\'s diagnosis has been added successfully.'); ; 
    
    }
}
