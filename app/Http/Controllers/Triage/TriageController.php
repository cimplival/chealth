<?php

namespace App\Http\Controllers\Triage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use App\Vital;
use App\Vitals2;
use App\Appointment;
use App\Payment;
use App\Triage;
use App\Examination;
use App\Activity;
use Carbon\Carbon;

class TriageController extends Controller
{
    public function getHome(Request $request)
    {
        $triages              = Triage::where('status',0)->where('service_id', '!=', 4)->get();
        $medical_certificates  = Triage::where('service_id', 4)->get();

        $activities   = Activity::where('from_user', $request->user()->id)->limit(20)->get();

        $date      = Carbon::now();

        $date2    = $date->parse('2 days ago')->formatLocalized('%A');

        $date3    = $date->parse('3 days ago')->formatLocalized('%A');

        $date4    = $date->parse('4 days ago')->formatLocalized('%A');

        $date5    = $date->parse('5 days ago')->formatLocalized('%A');

        $date6    = $date->parse('6 days ago')->formatLocalized('%A');

        $appointments0 = count(Appointment::whereRaw('date(created_at) = ?', [Carbon::today()])->get());

        $appointments1 = count(Appointment::whereRaw('date(created_at) = ?', [Carbon::yesterday()])->get());
        $appointments2 = count(Appointment::whereRaw('date(created_at) = ?', [Carbon::today()->subDays(2)])->get());
        $appointments3 = count(Appointment::whereRaw('date(created_at) = ?', [Carbon::today()->subDays(3)])->get());
        $appointments4 = count(Appointment::whereRaw('date(created_at) = ?', [Carbon::today()->subDays(4)])->get());
        $appointments5 = count(Appointment::whereRaw('date(created_at) = ?', [Carbon::today()->subDays(5)])->get());
        $appointments6 = count(Appointment::whereRaw('date(created_at) = ?', [Carbon::today()->subDays(6)])->get());

        return view('templates.triage.dashboard', compact(
            'triages', 
            'medical_certificates', 
            'activities',
            'date2',
            'date3',
            'date4',
            'date5',
            'date6',
            'appointments0',
            'appointments1',
            'appointments2',
            'appointments3',
            'appointments4',
            'appointments5',
            'appointments6'));
    }

    public function getPatients()
    {
        $triages  = Triage::paginate(10);

        return view('templates.triage.vitals', compact('triages'));
    }

    public function addVitals(Request $request)
    {
    	$this->validate($request, [
            'weight'          => 'required|numeric|max:300',
            'height'          => 'required|numeric|max:300',
            'bmi'             => 'required|numeric|max:100',
            'blood_pressure'  => 'required|numeric|max:500',
            'pulse'           => 'required|numeric|max:1000',
            'temperature'     => 'required|numeric|max:200',
            'cardiovascular'  => 'max:300',
            'respiratory'     => 'max:300',
            'abdomen'         => 'max:100',
            'blood_sugar'     => 'numeric|max:500',
            'stool'           => 'max:100',
            'urine'           => 'max:200',
            'hivI_II'         => 'max:500',
            'haemoglobin'     => 'max:300',
            ]);

        $triage_id  = $request->input('triage_id');
        $triage = Triage::where('id', $triage_id)->first();
        $from_user = $request->user()->id;


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

        $on_patient       = $triage->on_patient;
        $appointment_id   = $triage->appointment_id;
        $cardiovascular   = $request->input('cardiovascular');
        $respiratory      = $request->input('respiratory');
        $abdomen          = $request->input('respiratory');
        $blood_sugar      = $request->input('blood_sugar');
        $stool            = $request->input('stool');
        $urine            = $request->input('urine');
        $hivI_II          = $request->input('hivI_II');
        $haemoglobin      = $request->input('haemoglobin');

        if($on_patient || $appointment_id || $cardiovascular || $respiratory || $abdomen || $blood_sugar || $stool || $urine || $hivI_II || $haemoglobin) {
            $vitals2 = Vitals2::create([
                    'on_patient'      => $on_patient,
                    '$appointment_id' => $appointment_id,
                    'cardiovascular'  => $cardiovascular,
                    'respiratory'     => $respiratory,
                    'abdomen'         => $abdomen,
                    'blood_sugar'     => $blood_sugar,
                    'stool'           => $stool,
                    'urine'           => $urine,
                    'hivI_II'         => $hivI_II,
                    'haemoglobin'     => $haemoglobin,
                    'from_user'       => $from_user,
            ]);
        }

        Examination::create([
            'on_patient'      => $triage->on_patient,
            'appointment_id'  => $triage->appointment_id,
            'service_id'      => $triage->service_id,
            'status'          => 0,
            'from_user'       => $from_user
            ]);

        if($triage->service_id=="4"){

            $conclusion = $request->input('conclusion');
            $name_designate = $request->input('name_designate');

            Vitals2::where('id', $vitals2->id)->update(['conclusion' => $conclusion]);
            Vitals2::where('id', $vitals2->id)->update(['name_designate' => $name_designate]);

            Appointment::where('id', $triage->appointment_id)->update(['status' => 8]);   
        } else {
            Appointment::where('id', $triage->appointment_id)->update(['status' => 4]);
            Triage::where('id', $triage->id)->update(['status' => 1]);
        }

        $triages  = Triage::paginate(10);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " added vitals for ". $triage->patient->first_name. " " . $triage->patient->middle_name . " " . $triage->patient->last_name . " of Med ID: ". $triage->patient->med_id. ".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        return redirect()->route('triage-vitals', compact('triages'))->with('success', 'You have added vitals for the patient successfully.'); 
    }

    public function checkoutPatient($id)
    {
        //Update the appointment status field
        Appointment::where('id', $id)->update(['status' => 0]);


        Session::flash('info', 'You have successfully check out the patient from the triage.');

        return redirect()->route('triage-vitals'); 
    }

    public function searchVitals(Request $request)
    {
        $query = $request->input('search');

        $triages = Triage::where('from_user', 'LIKE', '%' . $query . '%')
        ->orwhereHas('patient', function ($term) use($query) {
            $term->where('first_name','LIKE', '%' . $query . '%');
            $term->orwhere('middle_name','LIKE', '%' . $query . '%');
            $term->orwhere('last_name','LIKE', '%' . $query . '%');
            $term->orwhere('date_birth','LIKE', '%' . $query . '%');
            $term->orwhere('estimated_age','LIKE', '%' . $query . '%');
            $term->orwhere('gender','LIKE', '%' . $query . '%');
            $term->orwhere('patient_phone','LIKE', '%' . $query . '%');
            $term->orwhere('kin_phone','LIKE', '%' . $query . '%');
            $term->orwhere('email','LIKE', '%' . $query . '%');
            $term->orwhere('residence','LIKE', '%' . $query . '%');
            $term->orwhere('county','LIKE', '%' . $query . '%');
            $term->orwhere('country_origin','LIKE', '%' . $query . '%');
        })->orWhereHas('appointment', function ($term) use($query) {
            $term->orwhere('from_user','LIKE', '%' . $query . '%');
        })->orWhereHas('service', function ($term) use($query) {
            $term->where('service_name','LIKE', '%' . $query . '%');
            $term->orwhere('cost','LIKE', '%' . $query . '%');
            $term->orwhere('from_user','LIKE', '%' . $query . '%');
        })->paginate(10);

        return view('templates.triage.vitals', compact('triages'))->with('success', 'There were ' . count($triages) .' search results.' );
    }
}
