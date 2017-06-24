<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Vital;
use App\Examination;
use DB;
use Session;
use Auth;
use App\Activity;
use App\Vitals2;

class VitalsController extends Controller
{
    public function addVitals(Request $request)
    {
    	$this->validate($request, [
                'weight'          => 'required|numeric|max:300',
                'height'          => 'required|numeric|max:300',
                'bmi'             => 'required|numeric|max:100',
                'blood_pressure'   => 'required|numeric|max:500',
                'pulse'           => 'required|numeric|max:1000',
                'temperature'     => 'required|numeric|max:200'
        ]);

        $examination_id = $request->input('examination_id');
        $examination    = Examination::where('id', $examination_id)->first();
        $from_user      = $request->user()->id;

        Vital::create([
                'appointment_id'  => $examination->appointment_id,
                'on_patient'      => $examination->on_patient,
                'from_user'       => $from_user,
                'weight'          => $request->input('weight'),
                'height'          => $request->input('height'),
                'bmi'             => $request->input('bmi'),
                'blood_pressure'   => $request->input('blood_pressure'),
                'pulse'           => $request->input('pulse'),
                'temperature'     => $request->input('temperature')
        ]);
            
        Vitals2::create([
                'on_patient'      => $examination->on_patient,
                '$appointment_id' => $examination->appointment_id,
                'cardiovascular'  => $request->input('cardiovascular'),
                'respiratory'     => $request->input('respiratory'),
                'abdomen'         => $request->input('abdomen'),
                'blood_sugar'     => $request->input('blood_sugar'),
                'stool'           => $request->input('stool'),
                'urine'           => $request->input('urine'),
                'hivI_II'         => $request->input('hiv_I_II'),
                'haemoglobin'     => $request->input('haemoglobin'),
                'from_user'       => $request->user()->id,
        ]);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " added vitals for the patient ". $examination->patient->first_name. " " . $examination->patient->middle_name. " " . $examination->patient->last_name . " of ". $examination->patient->med_id.".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

    	return redirect()->route('medical-profile'); 
    }
}
