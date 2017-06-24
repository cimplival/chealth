<?php

namespace App\Http\Controllers\Reception;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Appointment;
use App\Patient;
use App\Payment;
use App\Service;
use App\Http\Requests; 
use DB;
use Auth;
use Illuminate\Database\Query\Builder;
use Session;
use Carbon\Carbon;
use SMSProvider;
use App\Activity;
use App\Settings;
use App\Notification;
use App\Insurance;
use App\InsurancePlan;
use App\Triage;
use App\Inpatient;
use App\Bed;
use App\Ward;
use Mail;

class AppointmentsController extends Controller
{

    public function getAppointments(){
    	$appointments = Appointment::orderby('created_at', 'desc')->paginate(10);
        $services = Service::get();

        return view('templates.reception.appointments', compact('appointments', 'services'));
    }
    
    public function createAppointment(Request $request)
    {
    	$this->validate($request, [
            'service_id'        => 'required'
            ]);

        $service_id   = $request->input('service_id');
        $on_patient   = $request->input('on_patient');
        $from_user    = Auth::user()->id;
        $scheduled_at = Carbon::now();

        $service = Service::where('id', $service_id)->first();
        $provider_id = $service->provider_id;

        $insurance_plan = InsurancePlan::where('provider_id', $service->provider_id)->where('on_patient', $on_patient)->first();

        if($insurance_plan)
        {   
            $insurance_id = $insurance_plan->id;

            $cost = $service->cost;

            $insurance_plan_confirmed = $insurance_plan->value('confirmed');

            if($insurance_plan_confirmed == 1 && $service_id != 1) //Insurance Consultation
            {   
                $appointment  = Appointment::create([
                    'on_patient'          => $on_patient, 
                    'service_id'          => $service_id,
                    'staff_id'            => 0,
                    'scheduled_at'        => $scheduled_at,
                    'status'              => 1,
                    'from_user'           => $from_user,
                    ]);

                $payment = Payment::create([
                    'on_patient'          => $on_patient,
                    'appointment_id'      => $appointment->id,
                    'drug_id'             => 0,
                    'status'              => 1,
                    'cost'                => $cost,
                    'service_id'          => $appointment->service_id,
                    'insurance_id'        => $insurance_id,
                    'provider_id'         => $provider_id,
                    'from_user'           => $from_user,
                    ]);
                
                $insurance = Insurance::create([
                    'payment_id'           => $payment->id,
                    'on_patient'           => $payment->on_patient,
                    'appointment_id'       => $payment->appointment_id,
                    'insurance_id'         => $insurance_plan->id,
                    'service_id'           => $payment->service_id,
                    'cost'                 => $payment->cost,
                    'status'               => 1,
                    'from_user'            => $from_user,
                    ]);

                Triage::create([
                    'on_patient'          => $payment->on_patient,
                    'appointment_id'      => $payment->appointment_id,
                    'service_id'          => $payment->service_id, 
                    'status'              => 0,
                    'from_user'           => $from_user,
                    ]);

                Appointment::where('id', $appointment->id)->update(['status' => 2]);

                $insurance_id = $insurance->id;

                $flash  = 'success';
                $message = 'You have successfully created an appointment for the patient. Kindly direct the patient to the Triage.';
                ////////// Activity Log/////////////
                $from_user   = $request->user()->id;
                $description = " created appointment for ". $appointment->patient->first_name. " " . $appointment->patient->middle_name. " " . $appointment->patient->last_name . " of ". $appointment->patient->med_id.".";
                Activity::create(['from_user'=> $from_user,'description'=> $description]);
                ///////////////////////////////////
                return redirect()->route('reception-appointments')->with($flash, $message);
            } else {
                $message = 'Kindly first confirm the Insurance method from the Insurance provider before proceeding.';
                return redirect()->route('reception-appointments')->withErrors($message);
            }

        } else if($service->id == 1) //Self Sponsored Consultation
        {
            $insurance_id = 0;

            $appointment  = Appointment::create([
                'on_patient'          => $on_patient, 
                'service_id'          => $service_id,
                'staff_id'            => 0,
                'scheduled_at'        => $scheduled_at,
                'status'              => 1,
                'from_user'           => $from_user,
                ]);

            $cost = $appointment->service->cost;

            $payment = Payment::create([
                'on_patient'          => $on_patient,
                'appointment_id'      => $appointment->id,
                'drug_id'             => 0,
                'status'              => 0,
                'cost'                => $cost,
                'service_id'          => $appointment->service_id,
                'insurance_id'        => $insurance_id,
                'provider_id'         => $provider_id,
                'from_user'           => $from_user,
                ]);

            ////////// Activity Log/////////////
            $from_user   = $request->user()->id;
            $description = " created appointment for ". $appointment->patient->first_name. " " . $appointment->patient->middle_name. " " . $appointment->patient->last_name . " of ". $appointment->patient->med_id.".";
            Activity::create(['from_user'=> $from_user,'description'=> $description]);
            ///////////////////////////////////

            return redirect()->route('reception-appointments')->with('success', 'You have successfully created an appointment for the patient. Kindly direct the patient to the Accounts.');
        } elseif($service->id == 4) { //Medical Certificate
            $insurance_id = 0;

            $appointment  = Appointment::create([
                'on_patient'          => $on_patient, 
                'service_id'          => $service_id,
                'staff_id'            => 0,
                'scheduled_at'        => $scheduled_at,
                'status'              => 11,
                'from_user'           => $from_user,
                ]);

            $cost = $appointment->service->cost;

            $payment = Payment::create([
                'on_patient'          => $on_patient,
                'appointment_id'      => $appointment->id,
                'drug_id'             => 0,
                'status'              => 0,
                'cost'                => $cost,
                'service_id'          => $appointment->service_id,
                'insurance_id'        => $insurance_id,
                'provider_id'         => $provider_id,
                'from_user'           => $from_user,
                ]);

            ////////// Activity Log/////////////
            $from_user   = $request->user()->id;
            $description = " created appointment for ". $appointment->patient->first_name. " " . $appointment->patient->middle_name. " " . $appointment->patient->last_name . " of ". $appointment->patient->med_id.".";
            Activity::create(['from_user'=> $from_user,'description'=> $description]);
            ///////////////////////////////////

            return redirect()->route('reception-appointments')->with('success', 'You have successfully created an appointment for the patient for the Medical Certificate. Kindly direct the patient to the Accounts.');

        } elseif($service->id == 5) { //Service = Patient Admission
            $insurance_id = 0; 

            $this->validate($request, [
            'ward_id'             => 'required',
            'bed_id'              => 'required'
            ]);

            $user = $request->user()->id;
            $ward_id = $request->input('ward_id');
            $bed_id = $request->input('bed_id');

            $appointment  = Appointment::create([
                'on_patient'          => $on_patient, 
                'service_id'          => $service_id,
                'staff_id'            => 0,
                'scheduled_at'        => $scheduled_at,
                'status'              => 12, //Inpatient Status
                'from_user'           => $from_user,
                ]);

            $cost = $appointment->service->cost;

            $payment = Payment::create([
                'on_patient'          => $on_patient,
                'appointment_id'      => $appointment->id,
                'drug_id'             => 0,
                'status'              => 0,
                'cost'                => $cost,
                'service_id'          => $appointment->service_id,
                'insurance_id'        => $insurance_id,
                'provider_id'         => $provider_id,
                'from_user'           => $from_user,
                ]);

            /*Inpatient::create([
                'patient_id'       => $on_patient,
                'appointment_id'   => $appointment->id,
                'ward_id'          => $ward_id,
                'bed_id'           => $bed_id,
                'status'           => 0,
                'from_user'        => $user
                ]);

            $bed = Bed::where('id', $bed_id)->update(['bed_status' => 1]);

            $beds_in_ward = count(Bed::where('ward_no', $ward_id)->where('bed_status', 0)->get());

            if($beds_in_ward==0){
                Ward::where('id', $ward_id)->update(['ward_status' => 2]);
            }
*/
            ////////// Activity Log/////////////
            $from_user   = $request->user()->id;
            $description = " created appointment for ". $appointment->patient->first_name. " " . $appointment->patient->middle_name. " " . $appointment->patient->last_name . " of ". $appointment->patient->med_id.".";
            Activity::create(['from_user'=> $from_user,'description'=> $description]);
            ///////////////////////////////////

            return redirect()->route('reception-appointments')->with('success', 'You have successfully created an appointment for the patient for patient admission. Kindly direct the patient to the Accounts.');
        }
        else {    
            $message = 'Sorry, it appears that the patient is ineligible for the chosen service. This could be because they don\'t have the chosen insurance plan. Kindly go back and select the appropriate insurance plan.';
            return redirect()->route('reception-appointments')->withErrors($message);
        }
    }

    public function cancelAppointment(Request $request, $id)
    {   
        $appointment = Appointment::find($id);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " deleted appointment for ". $appointment->patient->first_name. " " . $appointment->patient->middle_name. " " . $appointment->patient->last_name . " of ". $appointment->patient->med_id.".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////
        

        $appointment->delete();

        return redirect()->route('reception-appointments')->with('success', 'The appointment has been cancelled successfully.');
    }

    public function updateAppointment(Request $request, $id)
    {
        $this->validate($request, [
            'service_id'              => 'required'
            ]);

        $updatedBy = $request->user()->id;
        $appointment = Appointment::find($id);

        $appointment->service_id;

        $appointment->save();

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " updated appointment for ". $appointment->patient->first_name. " " . $appointment->patient->middle_name. " " . $appointment->patient->last_name . " of ". $appointment->patient->med_id.".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////
        
        return redirect()->route('reception-appointments')->with('success', 'The appointment has been updated successfully.'); 
    }

    public function newAppointment()
    {
        $services           = DB::table('services')->get();
        $patient            = DB::table('patients')->orderBy('created_at', 'desc')->first();
        $insurance_plan     = InsurancePlan::where('on_patient', $patient->id)->first();

        if($insurance_plan)
        {
            $services = Service::where('provider_id', $insurance_plan->provider_id)->where('status', 1)->get();
        } else {
            $services = Service::where('provider_id', 1)->get();
        }

        $wards = Ward::where('ward_status', 1)->get();              

        $beds = Bed::where('bed_status', 0)->get();

        $settings = Settings::first();

        return view('templates.reception.new-appointment', compact('services','patient', 'services', 'wards', 'beds', 'settings'));
    }

    public function scheduleAppointment(Request $request)
    {
        $this->validate($request, [
            'service_id'        => 'required',
            ]);

        $on_patient   = $request->input('on_patient');
        $from_user    = Auth::user()->id;
        $scheduled_at = $request->input('scheduled_at');
        $scheduled_at = new carbon($scheduled_at);
        $service_id   = $request->input('service_id');

        $appointment  = Appointment::create([
            'on_patient'          => $on_patient, 
            'service_id'          => $service_id,
            'staff_id'            => 0,
            'scheduled_at'        => $scheduled_at,
            'status'              => 0,
            'from_user'           => $from_user,
            ]);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " scheduled an appointment for ". $appointment->patient->first_name. " " . $appointment->patient->middle_name. " " . $appointment->patient->last_name . " of ". $appointment->patient->med_id." for ". $appointment->service->service_name. " at ". $scheduled_at .".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////


        //Check if internet connection is on and if true send sms or/and email
        $hospital     = Settings::first();
        $sms_notification = Notification::where('id', 3)->where('status', 1)->first(); 
        $email_notification = Notification::where('id', 6)->where('status', 1)->first(); 
        $scheduled_at = $scheduled_at->format('l\\, jS \\of F Y \\a\\t g.iA'); 

        if($sms_notification)
        {   
            $response = null;
            system("ping -c 1 google.com", $response);
            if($response == 0)
            {
                $message = "Hello ". $appointment->patient->first_name ." ".$appointment->patient->last_name.". Your appointment at ". $hospital->name_of_institution ." is scheduled on " . $scheduled_at .". We look forward towards meeting you." ;
                SMSProvider::sendMessage($appointment->patient->patient_phone, $message);

                Activity::create(['from_user'=> $from_user,'description'=> "sent an sms for appointment."]);
            }
        }

        if($email_notification)
        {   
            $response = null;
            system("ping -c 1 google.com", $response);
            if($response == 0)
            {   
                $email_subject = "You have an appointment at ". $hospital->name_of_institution;
                $email_message = "Your appointment at ". $hospital->name_of_institution ." is scheduled on " . $scheduled_at .". We look forward towards meeting you.";
                $patient_email = $appointment->patient->email;
                $patient_name = $appointment->patient->first_name . ' ' . $appointment->patient->last_name;
                $data = ['subject' => $email_subject,'patient' => $appointment->patient, 'email_message' => $email_message, 'hospital'=> $hospital, 'email' => $appointment->patient->email, 'patient_name'=> $patient_name];

                Mail::send('templates.emails.email', $data, function($message) use ($data) {
                    $message->to($data['email'], $data['patient_name']);
                    $message->subject($data['subject']);
                });

                Activity::create(['from_user'=> $from_user,'description'=> " sent an email for appointment."]);
            }
        }

        return redirect()->route('reception-appointments')->with('success', 'The scheduled appointment has been created successfully.');

    }

    public function checkInPatient(Request $request)
    {
        $appointment_id = $request->input('appointment_id');   
        $appointment    = Appointment::where('id', $appointment_id)->first();
        $scheduled_at   = $appointment->scheduled_at; 
        $from_user      = $request->user()->id;

        $service_id   = $appointment->service->id;
        $on_patient   = $appointment->on_patient;

        $service = Service::where('id', $service_id)->first();
        $provider_id = $service->provider_id;

        $insurance_plan = InsurancePlan::where('provider_id', $service->provider_id)->where('on_patient', $on_patient)->first();

        if($insurance_plan)
        {   
            $insurance_id = $insurance_plan->id;

            $cost = $service->cost;

            $insurance_plan_confirmed = $insurance_plan->value('confirmed');

            if($insurance_plan_confirmed == 1 && $service_id != 1)
            {   
                $appointment  = Appointment::create([
                    'on_patient'          => $on_patient, 
                    'service_id'          => $service_id,
                    'staff_id'            => 0,
                    'scheduled_at'        => $scheduled_at,
                    'status'              => 1,
                    'from_user'           => $from_user,
                    ]);

                $payment = Payment::create([
                    'on_patient'          => $on_patient,
                    'appointment_id'      => $appointment->id,
                    'drug_id'             => 0,
                    'status'              => 1,
                    'cost'                => $cost,
                    'service_id'          => $appointment->service_id,
                    'insurance_id'        => $insurance_id,
                    'provider_id'         => $provider_id,
                    'from_user'           => $from_user,
                    ]);

                $insurance = Insurance::create([
                    'payment_id'           => $payment->id,
                    'on_patient'           => $payment->on_patient,
                    'appointment_id'       => $payment->appointment_id,
                    'insurance_id'         => $insurance_plan->id,
                    'service_id'           => $payment->service_id,
                    'cost'                 => $payment->cost,
                    'status'               => 1,
                    'from_user'            => $from_user,
                    ]);

                Appointment::where('id', $appointment->id)->update(['status' => 2]);

                $insurance_id = $insurance->id;

                $flash  = 'success';
                $message = 'You have successfully created an appointment for the patient. Kindly direct the patient to the Triage.';
                ////////// Activity Log/////////////
                $from_user   = $request->user()->id;
                $description = " created appointment for ". $appointment->patient->first_name. " " . $appointment->patient->middle_name. " " . $appointment->patient->last_name . " of ". $appointment->patient->med_id.".";
                Activity::create(['from_user'=> $from_user,'description'=> $description]);
                ///////////////////////////////////
                return redirect()->route('reception-appointments')->with($flash, $message);
            } else {
                $message = 'Kindly first confirm the Insurance method from the Insurance provider before proceeding.';
                return redirect()->route('reception-appointments')->withErrors($message);
            }

        } else if($service->id == 1)
        {
            $insurance_id = 0;

            $appointment  = Appointment::create([
                'on_patient'          => $on_patient, 
                'service_id'          => $service_id,
                'staff_id'            => 0,
                'scheduled_at'        => $scheduled_at,
                'status'              => 1,
                'from_user'           => $from_user,
                ]);

            $cost = $appointment->service->cost;

            $payment = Payment::create([
                'on_patient'          => $on_patient,
                'appointment_id'      => $appointment->id,
                'drug_id'             => 0,
                'status'              => 0,
                'cost'                => $cost,
                'service_id'          => $appointment->service_id,
                'insurance_id'        => $insurance_id,
                'provider_id'         => $provider_id,
                'from_user'           => $from_user,
                ]);

            ////////// Activity Log/////////////
            $from_user   = $request->user()->id;
            $description = " created appointment for ". $appointment->patient->first_name. " " . $appointment->patient->middle_name. " " . $appointment->patient->last_name . " of ". $appointment->patient->med_id.".";
            Activity::create(['from_user'=> $from_user,'description'=> $description]);
            ///////////////////////////////////

            return redirect()->route('reception-appointments')->with('success', 'You have successfully created an appointment for the patient. Kindly direct the patient to the Accounts.');
        } else {
            $message = 'Sorry, it appears that the patient is ineligible for chosen service. This could be because they don\'t have the chosen insurance plan. Kindly go back and select the appropriate insurance plan.';
            return redirect()->route('reception-appointments')->withErrors($message);
        }

        Payment::create([
            'on_patient'          => $appointment->on_patient,
            'appointment_id'      => $appointment->id,
            'drug_id'             => 0,
            'status'              => 0,
            'cost'                => $appointment->service->cost,
            'service_id'          => $appointment->service_id,
            'insurance_id'        => 0,
            'provider_id'         => $provider_id,
            'from_user'           => $from_user,
            ]);

        Appointment::where('id',$appointment_id)->update(['status' => 1]);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " checked in ". $appointment->patient->first_name. " " . $appointment->patient->middle_name. " " . $appointment->patient->last_name . " of ". $appointment->patient->med_id." for ". $appointment->service->service_name. " scheduled at ". $appointment->scheduled_at .".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        return redirect()->route('reception-appointments')->with('success', 'The patient has been checked in successfully.');
    }

}
