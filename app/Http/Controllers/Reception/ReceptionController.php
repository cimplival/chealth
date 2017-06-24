<?php

namespace App\Http\Controllers\Reception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Carbon\Carbon;
use Session;
use App\Role;
use Auth;
use App\User;
use App\Activity;
use App\Patient;
use App\Inventory;
use Illuminate\Contracts\Auth\Guard;
use App\Provider;
use App\UnknownPatient;
use App\Appointment;
use App\Service;
use App\Examination;
use App\Payment;
use App\Vital;
use App\Medication;
use App\Diagnosis;
use App\Immunization;
use App\Therapy;
use App\Procedure;
use App\History;
use App\Allergy;
use App\Lab;
use App\Settings;
use App\Vitals2;
use Lava;

class ReceptionController extends Controller
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    //GET HOME PAGE
    public function getHome(Request $request)
    {
        $appointments = count(Appointment::where('created_at','>=' , Carbon::now()->startOfDay())->get());

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
        return view('templates.reception.home', compact(
            'appointments', 
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
            'appointments6'
            ));
    }

    //GET PATIENTS
    public function getPatients()
    {
        return view('templates.reception.patients');
    }

    //GET PATIENT RESULTS
    public function getPatientsResults()
    {
        return view('templates.reception.patient-results');
    }

    //GET REGISTRATION
    public function getRegistration()
    {
        $providers = Provider::where('id','!=', 1)->get();

        return view('templates.reception.registration', compact('providers'));
    }

    //GET APPOINTMENTS
    public function getAppointments()
    {
        $appointments = count(Appointment::all());

        return view('templates.reception.appointments', compact('appointments'));
    }

    //GET Search Merge Patients
    /*public function getSearchMergePatients()
    {
        return view('templates.reception.patients-results-merge');
    }*/

    public function searchPatient(Request $request){
        $query = $request->input('search');
        $patient = DB::table('patients')->where('med_id', 'LIKE', '%' . $query . '%')
        ->orWhere('first_name', 'LIKE', '%' . $query . '%')
        ->orWhere('middle_name', 'LIKE', '%' . $query . '%')
        ->orWhere('last_name', 'LIKE', '%' . $query . '%')
        ->orWhere('date_birth', 'LIKE', '%' . $query . '%')
        ->orWhere('estimated_age', 'LIKE', '%' . $query . '%')
        ->orWhere('gender', 'LIKE', '%' . $query . '%')
        ->orWhere('patient_phone', 'LIKE', '%' . $query . '%')
        ->orWhere('kin_phone', 'LIKE', '%' . $query . '%')
        ->orWhere('residence', 'LIKE', '%' . $query . '%')
        ->orWhere('county', 'LIKE', '%' . $query . '%')
        ->orWhere('country_origin', 'LIKE', '%' . $query . '%')
        ->paginate(10);

        $services = DB::table('services')->get();
        $settings  = Settings::first();
        $pending   = Examination::where('status', 0)->orwhere('status',3)->get();
        $vitals2 = Vitals2::get();

        Session::flash('info', 'There were ' . count($patient) .' search results for "'. $query . '".' );

        return view('templates.reception.patient-results', compact('patient', 'query','services', 'settings', 'pending', 'vitals2'));
    }

    public function searchMergePatient(Request $request){

        $query = $request->input('search');
        $patient_original_id = $request->input('patient_id');
        $patient_original = Patient::where('id', $patient_original_id)->first();

        $patient = Patient::where('id','!=' , $patient_original_id)
        ->orwhere('med_id', 'LIKE', '%' . $query . '%')
        ->orWhere('first_name', 'LIKE', '%' . $query . '%')
        ->orWhere('middle_name', 'LIKE', '%' . $query . '%')
        ->orWhere('last_name', 'LIKE', '%' . $query . '%')
        ->orWhere('date_birth', 'LIKE', '%' . $query . '%')
        ->orWhere('estimated_age', 'LIKE', '%' . $query . '%')
        ->orWhere('gender', 'LIKE', '%' . $query . '%')
        ->orWhere('patient_phone', 'LIKE', '%' . $query . '%')
        ->orWhere('kin_phone', 'LIKE', '%' . $query . '%')
        ->orWhere('residence', 'LIKE', '%' . $query . '%')
        ->orWhere('county', 'LIKE', '%' . $query . '%')
        ->orWhere('country_origin', 'LIKE', '%' . $query . '%')
        ->paginate(10);

        $services = DB::table('services')->get();

        $pending   = Examination::where('status', 0)->orwhere('status',3)->get();
        $count_patient = count($patient);
        $count_patient = $count_patient;
        $count_patient = $count_patient-1;

        if($count_patient>=2){
            $patients_tense = "were"; 
        } else {
            $patients_tense = "was";
        }

        

        Session::flash('info', 'There '. $patients_tense . ' ' . $count_patient .' search results for "'. $query . '".' );

        return view('templates.reception.patients-results-merge', compact('patient_original', 'patient', 'query','services', 'pending'));
    }

    public function searchAppointment(Request $request){

        $query = $request->input('search');

        $appointments = Appointment::where('scheduled_at', 'LIKE', '%' . $query . '%')
        ->where('from_user', 'LIKE', '%' . $query . '%')
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
        })
        ->orWhereHas('service', function ($term) use($query) {
            $term->where('service_name','LIKE', '%' . $query . '%');
            $term->orwhere('cost','LIKE', '%' . $query . '%');
            $term->orwhere('from_user','LIKE', '%' . $query . '%');
        })->paginate(10);

        $services = DB::table('services')->get();

        return view('templates.reception.appointments', compact('appointments','query', 'services'))->with('info', 'There were ' . count($appointments) .' search results for "'. $query . '".' );
    }

    public function getUnknownPatient(){
        $drugs         = Inventory::get();
        $unknown_patients = UnknownPatient::get();

        return view('templates.reception.unknown-patient', compact('drugs', 'unknown_patients'));
    }

    public function addUnknownPatient(Request $request){

        $this->validate($request, [
            'first_name'             => 'max:265',
            'middle_name'            => 'max:265',
            'last_name'              => 'max:265',
            'date_birth'             => 'max:20',
            'estimated_age'          => 'max:150',
            'gender'                 => 'max:10',
            'patient_phone'          => 'max:20',
            'kin_name'               => 'max:30',
            'kin_phone'              => 'max:20',
            'kin_relationship'       => 'max:30',
            'email'                  => 'max:265',
            'residence'              => 'max:100',
            'county'                 => 'max:100',
            'country_origin'         => 'max:100'
            ]);

        $first_name           = $request->input('first_name');
        $middle_name          = $request->input('middle_name');
        $last_name            = $request->input('last_name');
        $date_birth           = $request->input('date_birth'); 
        $date_birth           = new carbon($date_birth);
        $estimated_age        = $request->input('estimated_age');
        $gender               = $request->input('gender');
        $patient_phone        = $request->input('patient_phone');
        $kin_name             = $request->input('kin_name');
        $kin_relationship     = $request->input('kin_relationship');
        $kin_phone            = $request->input('kin_phone');
        $email                = $request->input('email');
        $residence            = $request->input('residence');
        $county               = $request->input('county');
        $country_origin       = $request->input('country_origin');
        $from_user            = Auth::user()->id;

        $patient_phone = $request->input('patient_phone');

        $identifier = "Med ID: ";
        //fetch id no of previous record and add one to it
        $fetch_no = Patient::all();

        if (count($fetch_no)!=0) {
            $fetch_no = DB::table('patients')->orderBy('created_at', 'desc')->first()->id;
            $fetch_no = (int)$fetch_no;
            $fetch_no = $fetch_no + 1;

            $med_id = $identifier. $fetch_no;

            $patient = Patient::create([
                'med_id'                 => $med_id,
                'first_name'             => $first_name,
                'middle_name'            => $middle_name,
                'last_name'              => $last_name,
                'date_birth'             => $date_birth,
                'estimated_age'          => $estimated_age,
                'gender'                 => $gender,
                'patient_phone'          => $patient_phone,
                'kin_name'               => $kin_name,
                'kin_phone'              => $kin_phone,
                'kin_relationship'       => $kin_relationship,
                'email'                  => $email,
                'residence'              => $residence,
                'county'                 => $county,
                'country_origin'         => $country_origin,
                'from_user'              => $from_user,
                ]);

        } else
        {
            $fetch_no = 1;
            $fetch_no = (int)$fetch_no;

            $med_id = $identifier . $fetch_no;

            $patient = Patient::create([
                'med_id'                 => $med_id,
                'first_name'             => $first_name,
                'middle_name'            => $middle_name,
                'last_name'              => $last_name,
                'date_birth'             => $date_birth,
                'estimated_age'          => $estimated_age,
                'gender'                 => $gender,
                'patient_phone'          => $patient_phone,
                'kin_name'               => $kin_name,
                'kin_relationship'       => $kin_relationship,
                'kin_phone'              => $kin_phone,
                'email'                  => $email,
                'residence'              => $residence,
                'county'                 => $county,
                'country_origin'         => $country_origin,
                'from_user'              => $from_user,
                ]);
        }

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " registered a patient ". $patient->first_name. " " . $patient->middle_name. " " . $patient->last_name . " of ". $patient->med_id.".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        $scheduled_at = Carbon::now();
        $service = Service::where('id', 3)->first();
        $cost = $service->cost;

        $appointment  = Appointment::create([
            'on_patient'          => $patient->id, 
            'service_id'          => 3,
            'staff_id'            => 0,
            'scheduled_at'        => $scheduled_at,
            'status'              => 4,
            'from_user'           => $from_user,
            ]);

        $payment = Payment::create([
            'on_patient'          => $patient->id,
            'appointment_id'      => $appointment->id,
            'drug_id'             => 0,
            'status'              => 0,
            'cost'                => $cost,
            'service_id'          => $appointment->service_id,
            'insurance_id'        => 0,
            'provider_id'         => $service->provider_id,
            'from_user'           => $from_user,
            ]);

        Examination::create([
            'on_patient'      => $patient->id,
            'appointment_id'  => $appointment->id,
            'service_id'      => $appointment->service_id,
            'status'          => 0,
            'from_user'       => $from_user
            ]);

        UnknownPatient::create([
            'patient_id'     => $patient->id,
            'appointment_id' => $appointment->id,
            'from_user'      => $from_user
            ]);

        $unknown_patients = UnknownPatient::get();

        return redirect()->route('unknown-patient', compact('unknown_patients'))->with('success', 'The unknown patient\'s medical profile has been created successfully');
    }
}
