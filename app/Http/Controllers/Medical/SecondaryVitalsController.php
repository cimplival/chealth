<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use DB;
use App\Vital;
use App\Vitals2;
use App\Appointment;
use App\Diagnosis;
use App\History;
use App\Allergy;
use App\Patient;
use App\Settings;
use PDF;

class SecondaryVitalsController extends Controller
{
    public function getPatients()
    {
        return view('templates.triage.certificate');
    }

    public function getMedicalCertificate()
    {
        $appointments  = DB::table('appointments')->where('serviceType',"Medical Certificate")->where('status',"Triage")->paginate(10);

    	return view('templates.triage.export-certificate', compact('appointments'));
    }

    public function saveAllVitals(Request $request)
    {
    	$this->validate($request, [
                'weight'          => 'required|numeric|max:300',
                'height'          => 'required|numeric|max:300',
                'bmi'             => 'required|numeric|max:100',
                'bloodPressure'   => 'required|numeric|max:500',
                'pulse'           => 'required|numeric|max:1000',
                'temperature'     => 'required|numeric|max:300',
                'cardiovascular'  => 'required|max:300',
                'respiratory'     => 'required|max:300',
                'abdomen'         => 'required|max:100',
                'blood_sugar'     => 'required|numeric|max:500',
                'stool'           => 'required|max:100',
                'urine'           => 'required|max:200',
                'hivI_II'         => 'required|max:500',
                'haemoglobin'     => 'required|max:300',
                'conclusion'      => 'required|max:1000',
                'name_designate'  => 'required|max:200'
        ]);

        $triage_id  = $request->input('triage_id');
        
        $triage = Triage::where('id','triage')->first();


        $vital = Vital::create([
            '$appointment_id' => $triage->appointment_id,
            'on_patient'      => $triage->on_patient,
            'weight'          => $request->input('weight'),
            'height'          => $request->input('height'),
            'bmi'             => $request->input('bmi'),
            'blood_pressure'  => $request->input('blood_pressure'),
            'pulse'           => $request->input('pulse'),
            'temperature'     => $request->input('temperature'),
            'from_user'       => $from_user
            ]);

        Vitals2::create([
                'on_patient'      => $triage->on_patient,
                '$appointment_id' => $triage->appointment_id,
                'cardiovascular'  => $request->input('cardiovascular'),
                'respiratory'     => $request->input('respiratory'),
                'abdomen'         => $request->input('abdomen'),
                'blood_sugar'     => $request->input('blood_sugar'),
                'stool'           => $request->input('stool'),
                'urine'           => $request->input('urine'),
                'hivI_II'         => $request->input('hivI_II'),
                'haemoglobin'     => $request->input('haemoglobin'),
                'from_user'       => $request->user()->id,
        ]);

        $triages  = Triage::paginate(10);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " added vitals for ". $triage->patient->first_name. " " . $triage->patient->middle_name . " " . $triage->patient->last_name . " of Med ID: ". $triage->patient->med_id. ". The patient's examination record was created, appointment status and triage status was also updated.";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        return redirect()->route('triage-vitals', compact('triages'))->with('success', 'You have added vitals to the triage successfully.'); 
    }

    public function exportCertificate(Request $request)
    {
    	$patient_id  = $request->input('patient_id');

        $appointment_id  = $request->input('appointment_id');

   	    $patient = Patient::where('id', $patient_id)->first();

        $vital = Vital::orderby('created_at', 'desc')->where('on_patient', $patient_id)->first();

        $vitals2 = Vitals2::where('on_patient', $patient_id)->orderby('created_at', 'desc')->first();

        $diagnosis = Diagnosis::orderby('created_at', 'desc')->where('on_patient', $patient_id)->first();

        $histories = History::orderby('created_at', 'desc')->where('on_patient', $patient_id)->first();
    
        $allergies = Allergy::where('on_patient', $patient_id)->orderby('created_at', 'desc')->first();

        $appointment_created = Appointment::where('on_patient', $patient_id)->orderby('created_at', 'desc')->first();

        $appointment_created = Carbon::parse($appointment_created->created_at)->format('jS  F Y'); 

        $settings = Settings::first();

        $pdf = PDF::loadView('templates.reports.medical-certificate.medical-certificate',
                compact(
                        'carbon',
                        'patient',
                        'vital',
                        'vitals2',
                        'diagnosis',
                        'histories',
                        'allergies',
                        'appointment_created',
                        'settings'
                ));

        return $pdf->download('Medical Certificate - '.$patient->first_name.' '. $patient->last_name .' ('. $patient->med_id .').pdf');
    }
}
