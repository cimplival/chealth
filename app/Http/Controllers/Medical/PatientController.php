<?php

namespace App\Http\Controllers\Medical;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use DB;
use Input;
use Session;
use Carbon\Carbon;
use SMSProvider;
use App\Activity;
use App\Settings;
use App\Notification;
use App\InsurancePlan;
use App\Patient;
use App\Vital;
use App\Vitals2;
use App\Medication;
use App\Allergy;
use App\Therapy;
use App\Immunization;
use App\Procedure;
use App\History;
use App\Lab;
use App\Appointment;
use App\Dispensation;
use App\Examination;
use App\Insurace;
use App\Diagnosis;
use App\Insurance;
use App\Payment;
use App\Triage;
use App\UnknownPatient;
use Mail;

class PatientController extends Controller
{
    public function searchPatient(){
    	$query = $request->input('search');
        $patient = DB::table('patients')->where('*', 'LIKE', '%' . $query . '%')->paginate(100);

        return view('templates.reception.patient-results', compact('patient', 'query'));
    }

    public function RegisterPatient(Request $request)
    {
    	$this->validate($request, [
            'first_name'             => 'required|min:2|max:265',
            'middle_name'            => 'max:265',
            'last_name'              => 'max:265',
            'date_birth'             => 'max:20',
            'estimated_age'          => 'max:150',
            'gender'                 => 'required|max:10',
            'patient_phone'          => 'max:20',
            'kin_phone'              => 'max:20',
            'kin_relationship'       => 'max:30',
            'email'                  => 'max:265',
            'residence'              => 'required|min:2|max:100',
            'county'                 => 'max:100',
            'country_origin'         => 'max:100',
            'insurance_identifier'   => 'max:100',
            'insurance_provider'     => 'max:100'
            ]);

        $first_name           = $request->input('first_name');
        $middle_name          = $request->input('middle_name');
        $last_name            = $request->input('last_name');
        $date_birth           = $request->input('date_birth'); $date_birth = new carbon($date_birth);
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

        $national_id          = $request->input('national_id');
        $insurance_identifier = $request->input('insurance_identifier');
        $provider_id          = $request->input('provider_id');

        $patient_name  = $request->input('first_name')." ". 
        $request->input('middle_name')." ". 
        $request->input('last_name');
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

            if($national_id!="" && $provider_id!="" && $insurance_identifier!="")
            {
                InsurancePlan::create([
                    'on_patient'             => $patient->id,
                    'national_id'            => $national_id,
                    'insurance_identifier'   => $insurance_identifier,
                    'provider_id'            => $provider_id, 
                    'from_user'              => $from_user
                    ]);
            }

            

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

            if($national_id!="" && $provider_id!="" && $insurance_identifier!="")
            {
                InsurancePlan::create([
                    'on_patient'             => $patient->id,
                    'national_id'            => $national_id,
                    'insurance_identifier'   => $insurance_identifier,
                    'provider_id'            => $provider_id, 
                    'from_user'              => $from_user
                    ]);
            }

        }

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " registered a patient ". $patient->first_name. " " . $patient->middle_name. " " . $patient->last_name . " of ". $patient->med_id.".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        //Check if internet connection is on and if true send sms or/and email
        $hospital     = Settings::first();
        $sms_notification = Notification::where('id', 1)->where('status', 1)->first();
        $email_notification = Notification::where('id', 4)->where('status', 1)->first(); 

        if($sms_notification)
        {
            $response = null;
            system("ping -c 1 google.com", $response);
            if($response == 0)
            {
                $message = "Hello ". $patient_name . "! Welcome to ". $hospital->name_of_institution .". You have been registered as one of our patients. Kindly, Save ". $hospital->phone_no ." as our phone no. for future enquiries. We wish you quick a recovery.";
                SMSProvider::sendMessage($patient_phone, $message);
                Activity::create(['from_user'=> $from_user,'description'=> "sent an SMS to the patient ".$patient->first_name. " " . $patient->middle_name. " " . $patient->last_name . " of ". $patient->med_id."after registration." ]);
            }
        }

        if($email_notification)
        {   
            $response = null;
            system("ping -c 1 google.com", $response);
            if($response == 0)
            {   
                $email_subject = "You have been registered at ". $hospital->name_of_institution;
                $email_message = 'Welcome to '. $hospital->name_of_institution .'. You have been registered as one of our patients. Kindly, Save '.  $hospital->phone_no .' as our phone no. for future enquiries. We wish you all the best.';
                $patient_email = $patient->email;
                $patient_name = $patient->first_name . ' ' . $patient->last_name;
                $data = ['subject' => $email_subject,'patient' => $patient, 'email_message' => $email_message, 'hospital'=> $hospital, 'email' => $patient_email, 'patient_name'=> $patient_name];

                Mail::send('templates.emails.email', $data, function($message) use ($data) {
                    $message->to($data['email'], $data['patient_name']);
                    $message->subject($data['subject']);
                });

                Activity::create(['from_user'=> $from_user,'description'=> " sent an email after registration."]);
            }
        }

        return redirect()->route('new-appointment')->with('success', $first_name. ' '. $last_name .'\'s Medical Profile has been created successfully');
    }

    public function updatePatient($id, Request $request){
        $this->validate($request, [
            'first_name'             => 'required|min:2|max:265',
            'middle_name'            => 'max:265',
            'last_name'              => 'max:265',
            'date_birth'             => 'max:20',
            'estimated_age'          => 'max:150',
            'gender'                 => 'required|max:10',
            'patient_phone'          => 'max:20',
            'kin_phone'              => 'max:20',
            'email'                  => 'max:265',
            'residence'              => 'required|min:2|max:100',
            'county'                 => 'max:100',
            'country_origin'         => 'max:100',
            ]);

        $from_user =  $request->user()->id;

        $patient = Patient::where('id', $id)->first();
        $input = $request->all();
        $patient->fill($input)->save();

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " a updated details for patient named ". $patient->first_name. " " . $patient->middle_name. " " . $patient->last_name . " of ". $patient->med_id.".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        return redirect()->route('medical-profile'); 
    }

    public function mergePatients(Request $request){
        $patient_original_id = $request->input('original_patient');
        $patient_existing_id = $request->input('existing_patient');

        $patient_original = Patient::where('id', $patient_original_id)->first();
        $patient_existing = Patient::where('id', $patient_existing_id)->first();

        //Merge patient record if the existing field value is null
        if($patient_existing->first_name == ""){
            $patient_existing->update(['first_name' => $patient_original->first_name]);
        } 
        if($patient_existing->middle_name == "") {
            $patient_existing->update(['middle_name' => $patient_original->middle_name]);
        } 
        if($patient_existing->last_name == ""){
            $patient_existing->update(['last_name' => $patient_original->last_name]);
        } 
        if($patient_existing->date_birth == ""){
            $patient_existing->update(['date_birth' => $patient_original->date_birth]);
        } 
        if($patient_existing->estimated_age == ""){
            $patient_existing->update(['estimated_age' => $patient_original->estimated_age]);
        } 
        if($patient_existing->gender == ""){
            $patient_existing->update(['gender' => $patient_original->gender]);
        } 
        if($patient_existing->patient_phone == ""){
            $patient_existing->update(['patient_phone' => $patient_original->patient_phone]);
        } 
        if($patient_existing->kin_name == ""){
            $patient_existing->update(['kin_name' => $patient_original->kin_name]);
        } 
        if($patient_existing->kin_relationship == ""){
            $patient_existing->update(['kin_relationship' => $patient_original->kin_relationship]);
        } 
        if($patient_existing->kin_phone == ""){
            $patient_existing->update(['kin_phone' => $patient_original->kin_phone]);
        } 
        if($patient_existing->email == ""){
            $patient_existing->update(['email' => $patient_original->email]);
        }   
        if($patient_existing->residence == ""){
            $patient_existing->update(['residence' => $patient_original->residence]);
        } 
        if($patient_existing->county == ""){
            $patient_existing->update(['county' => $patient_original->county]);
        } 
        if($patient_existing->country_origin == ""){
            $patient_existing->update(['country_origin' => $patient_original->country_origin]);
        } 
        if($patient_existing->from_user == ""){
            $patient_existing->update(['from_user' => $patient_original->from_user]);
        } 
        if($patient_existing->county == ""){
            $patient_existing->update(['county' => $patient_original->county]);
        }

        //to merge change the value of id to patient exisitng's
        $vitals = Vital::where('on_patient', $patient_original_id)->get();
        if($vitals){
            Vital::where('on_patient', $patient_original_id)->update(['on_patient' => $patient_existing_id]);
        }

        $vitals2 = Vitals2::where('on_patient', $patient_original_id)->get();
        if($vitals2){
            Vitals2::where('on_patient', $patient_original_id)->update(['on_patient' => $patient_existing_id]);
        }

        $diagnosis = Diagnosis::where('on_patient', $patient_original_id)->get();
        if($diagnosis){
            Diagnosis::where('on_patient', $patient_original_id)->update(['on_patient' => $patient_existing_id]);
        }

        $medications = Medication::where('on_patient', $patient_original->id)->get();
        if($medications){
            Medication::where('on_patient', $patient_original->id)->update(['on_patient' => $patient_existing->id]);
        }

        $allergies = Allergy::where('on_patient', $patient_original->id)->get();
        if($allergies){
            Allergy::where('on_patient', $patient_original->id)->update(['on_patient' => $patient_existing->id]);
        }

        $therapies = Therapy::where('on_patient', $patient_original->id)->get();
        if($therapies){
            Therapy::where('on_patient', $patient_original->id)->update(['on_patient' => $patient_existing->id]);
        }

        $immunizations = Immunization::where('on_patient', $patient_original->id)->get();
        if($immunizations){
            Immunization::where('on_patient', $patient_original->id)->update(['on_patient' => $patient_existing->id]);
        }

        $procedures = Procedure::where('on_patient', $patient_original->id)->get();
        if($procedures){
            Procedure::where('on_patient', $patient_original->id)->update(['on_patient' => $patient_existing->id]);
        }

        $histories = History::where('on_patient', $patient_original->id)->get();
        if($histories){
            History::where('on_patient', $patient_original->id)->update(['on_patient' => $patient_existing->id]);
        }

        $labs = Lab::where('on_patient', $patient_original->id)->get();
        if($labs){
            Lab::where('on_patient', $patient_original->id)->update(['on_patient' => $patient_existing->id]);
        }

        $appointments = Appointment::where('on_patient', $patient_original->id)->get();
        if($appointments){
            Appointment::where('on_patient', $patient_original->id)->update(['on_patient' => $patient_existing->id]);
        }

        $dispensations = Dispensation::where('on_patient', $patient_original->id)->get();
        if($dispensations){
            Dispensation::where('on_patient', $patient_original->id)->update(['on_patient' => $patient_existing->id]);
        }

        $examinations = Examination::where('on_patient', $patient_original->id)->get();
        if($examinations){
            Examination::where('on_patient', $patient_original->id)->update(['on_patient' => $patient_existing->id]);
        }

        $insurances = Insurance::where('on_patient', $patient_original->id)->get();
        if($insurances){
            Insurance::where('on_patient', $patient_original->id)->update(['on_patient' => $patient_existing->id]);
        }

        $payments = Payment::where('on_patient', $patient_original->id)->get();
        if($payments){
            Payment::where('on_patient', $patient_original->id)->update(['on_patient' => $patient_existing->id]);
        }

        $triages = Triage::where('on_patient', $patient_original->id)->get();
        if($triages){
            Triage::where('on_patient', $patient_original->id)->update(['on_patient' => $patient_existing->id]);
        }

        $unknown_patient = UnknownPatient::where('patient_id', $patient_existing->id)->delete();
        $delete_the_unknown_patient_record = Patient::where('id', $patient_original->id )->delete();

        return redirect()->route('reception-registration')->with('success', 'The patient\'s medical records were successfully merged.');
    }
}
