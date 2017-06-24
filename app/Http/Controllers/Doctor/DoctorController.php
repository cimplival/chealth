<?php

namespace App\Http\Controllers\Doctor;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Appointment;
use App\Patient;
use Illuminate\Http\Request;
use App\Vital;
use App\Http\Requests;
use Session;
use App\Medication;
use App\Examination;
use App\Inventory;
use App\Dispensation;
use App\Activity;
use App\Settings;
use App\Notification;
use Carbon\Carbon;
use Mail;

class DoctorController extends Controller
{
    //GET DASHBOARD PAGE
    public function getDashboard(Request $request)
    {
        $examinations  = Examination::where('status', 0)->paginate(10);

        $user = $request->user()->id;
        $activities   = Activity::where('from_user', $request->user()->id)->limit(20)->get();

        $examination   = Examination::where('status', 0)->where('status',3)->where('from_user', $request->user()->id)->first();

        $pending   = Examination::where('status', 0)->orwhere('status',3)->get();

        $date      = Carbon::now();

        $date2    = Carbon::yesterday()->formatLocalized('%A');

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

        return view('templates.doctor.dashboard', compact(
            'pending', 
            'examination', 
            'examinations', 
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

    //GET APPOINTMENTS PAGE
    public function getDoctorAppointments(Request $request)
    {
        $examinations  = Examination::paginate(10);

        $examination   = Examination::where('status', 0)->where('status',3)->orWhere('from_user', $request->user()->id)->first();

        $pending   = Examination::where('status', 0)->orwhere('status',3)->get();

        return view('templates.doctor.doctor-appointments', compact('pending' ,'examinations', 'examination'));
    }

    //GET CONSULTATIONS PAGE
    public function getDoctorHistory(Request $request)
    {
        $user_id = $request->user()->id;

        $examinations  = Examination::where('user_id', $user_id)->paginate(10);

        return view('templates.doctor.doctor-consultations', compact('examinations'));
    }

    //GET CALENDAR PAGE
    public function getDoctorCalendar()
    {
        return view('templates.doctor.doctor-calendar');
    }

    public function viewMedicalProfile(Request $request, $id)
    {
        $patient    = Patient::where('id', $id)->first();
        $patient_id = $patient->id;

        $vitals=0;
        if($patient){
            $patient_id  = $patient->id;
            $vitals      = Vital::where('on_patient', $patient_id)->paginate(10);
            $medications = Medication::where('on_patient', $patient_id)->paginate(10);
        }
        return redirect()->route('medical-profile');
    }

    //CONSULT PATIENT
    public function consultPatient(Request $request, $id)
    {
        $examination             = Examination::where('id', $id)->first();
        $patient                 = Patient::where('id', $examination->on_patient)->first();
        $patient_id              = $patient->id;

        $vitals=0;
        if($patient){
            $patient_id  = $patient->id;
            $vitals      = Vital::where('on_patient', $patient_id)->paginate(10);
            $medications = Medication::where('on_patient', $patient_id)->paginate(10);
        }

        $drugs = Inventory::get();
        Examination::where('id', $id)->update(['status' => 1]);
        Examination::where('id', $id)->update(['from_user' => $request->user()->id]);

            ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " consulted ". $patient->first_name. " " . $patient->middle_name . " " . $patient->last_name . " of ". $patient->med_id. ". The examination status was also updated.";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
            ///////////////////////////////////

        return redirect()->route('medical-profile');

    }

    //Onclick on the discharge button in the medical profile
    public function consulted(Request $request, $id)
    {
        $examination = Examination::where('id', $id)->first();
        Examination::where('id', $id)->update(['status' => 4]);   //status = 0,1,2,3,4 = not consulted, consulting, lab, from lab, consulted  

        $appointment_id = $examination->appointment_id;

        $appointment = Appointment::where('id', $id)->first();
        $dispensation = Dispensation::where('appointment_id', $appointment_id)->where('status', 1)->first();
        $from_user            = Auth::user()->id;

        if($dispensation)
        {   
            if(!$appointment->status == 8)
            {
                $appointment->update(['status' => 9]);
            }

            ////////// Activity Log/////////////
            $from_user   = $request->user()->id;
            $description = " finished examination for ". $examination->patient->first_name. " " . $examination->patient->middle_name . " " . $examination->patient->last_name . " of ". $examination->patient->med_id. ". and changed the appointment status to pharmacy.";
            Activity::create(['from_user'=> $from_user,'description'=> $description]);
            ///////////////////////////////////

        } else {
            $appointment->update(['status' => 8]);
        }

        //Check if internet connection is on and if true send notification
            $hospital           = Settings::first();
            $notification       = Notification::where('id', 2)->where('status', 1)->first();
            $email_notification = Notification::where('id', 5)->where('status', 1)->first(); 

            if($notification)
            {
                $response = null;
                system("ping -c 1 google.com", $response);
                if($response == 0)
                {
                    $message = "Hello ". $appointment->patient->first_name ." ".$appointment->patient->last_name.". Thank you for choosing ". $hospital->name_of_institution .". We hope you loved our care. We wish you quick recovery. Kindly save our contact ". $hospital->phone_no." for future enquiries if you haven't done so. Thank you.";
                    SMSProvider::sendMessage($appointment->patient->patient_phone, $message);
                    Activity::create(['from_user'=> $from_user,'description'=> "sent an sms after appointment."]);
                }
            }

            if($email_notification)
            {   
                $response = null;
                system("ping -c 1 google.com", $response);
                if($response == 0)
                {   
                    $email_subject = "Thank you for choosing ". $hospital->name_of_institution;

                    $email_message = "Thank you for visiting us at ". $hospital->name_of_institution .". We hope you loved our care. We wish you all the best in your recovery. Kindly save our contact ". $hospital->phone_no." for future enquiries if you haven't done so. Thank you.";

                    $patient_email = $appointment->patient->email;
                    $patient_name = $appointment->patient->first_name . ' ' . $appointment->patient->last_name;
                    $data = ['subject' => $email_subject,'patient' => $appointment->patient, 'email_message' => $email_message, 'hospital'=> $hospital, 'email' => $appointment->patient->email, 'patient_name'=> $patient_name];

                    Mail::send('templates.emails.email', $data, function($message) use ($data) {
                        $message->to($data['email'], $data['patient_name']);
                        $message->subject($data['subject']);
                    });

                    Activity::create(['from_user'=> $from_user,'description'=> "sent an email after appointment."]);
                }
            }

        return redirect()->route('medical-profile')->with('success', 'The patient has been discharged successfully.');

    }

    public function labVisit($id)
    {
        $examination = Examination::where('id', $id)->first();
        $examination->update(['status' => 2]);   //status = 0,1,2,3,4 = not consulted, consulting, lab, from lab, consulted 

        return redirect()->route('doctor-appointments')->with('success', 'The patient will come back after the lab test. Kindly direct the patient to the lab.'); 
    }

    public function cancelAppointment(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        $patientName = $appointment->patient;

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " cancelled appointment for the patient ". $patient->first_name. " " . $patient->middle_name . " " . $patient->last_name . " of ". $patient->med_id. ".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////


        $appointment->delete();

        return redirect()->route('doctor-appointments')->with('success', 'You have canceled successfully the appointment for '.$patientName .'.');
    }
}
