<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;
use App\Appointment;
use App\Patient;
use Illuminate\Http\Request;
use Auth;
use DB;
use Input;
use Session;
use App\Http\Requests;
use App\Vital;
use App\Vitals2;
use App\Medication;
use App\Service;
use App\Diagnosis;
use App\Immunization;
use App\Therapy;
use App\Procedure;
use App\History;
use App\Allergy;
use App\Lab;
use App\Examination;
use App\Inventory;
use PDF;
use App\Settings;
use App\Payment;
use App\Provider;
use App\Inpatient;
use App\Ward;
use App\Bed;
use Redirect;
use Carbon\Carbon;

class MedicalController extends Controller
{
     //GET HOME PAGE
    public function getHome(Request $request)
    {


        //if there is examination with status 1 viewed by current user then show it on medical profile
        //$examination    = Examination::where('status', 1)->where('from_user', $user)->first();

        $examination   = Examination::where('status', 1)->where('from_user', $request->user()->id)->first();
        
        $vitals=0;
        if($examination){
            $appointment_id = $examination->appointment_id;

            $patient = Patient::where('id', $examination->on_patient)->first();
            $on_patient = $examination->on_patient;
            //Get vitals records
            $vitals = Vital::where('on_patient', $on_patient)->paginate(10);

            $vitals2 = Vitals2::where('on_patient', $on_patient)->paginate(10);

            //Get medications to display on medical profile
            $medications = Medication::where('on_patient', $on_patient)->paginate(10, ['*'], 'medications' );

            //Get diagnosis to display on the medical profile
            $diagnosis = Diagnosis::where('on_patient', $on_patient)->paginate(10, ['*'], 'diagnosis');

            //Get immunizations to display on the medical profile
            $immunizations = Immunization::where('on_patient', $on_patient)->paginate(10, ['*'], 'immunizations');

            //Get therapies to display on the medical profile
            $therapies = Therapy::where('on_patient', $on_patient)->paginate(10, ['*'], 'therapies');

            //Get procedures to display on the medical profile
            $procedures = Procedure::where('on_patient', $on_patient)->paginate(10, ['*'], 'procedures');

            //Get histories to display on the medical profile
            $histories = History::where('on_patient', $on_patient)->paginate(10, ['*'], 'histories');

            //Get allergies to display on the medical profile
            $allergies = Allergy::where('on_patient', $on_patient)->paginate(10, ['*'], 'allergies');

            //Get lab records to display on the medical profile
            $labs = Lab::where('on_patient', $on_patient)->paginate(10, ['*'], 'labs');

            $appointment = Appointment::where('id', $appointment_id)->first();
            $service_id  = $appointment->value('service_id');

            $service        = Service::where('id', $service_id)->first();
            $provider_id    = $service->provider_id;

            $services = Service::where('provider_id', $provider_id)->get();

            //Meant to check whether the patient will come back to the doctor
            $patient_return = Lab::where('on_patient',$on_patient)->where('status', 1)->first();

            $examination->update(['status' => 1]);

            $inpatients = Inpatient::paginate(10);

            $wards = Ward::where('ward_status', 1)->get();

            $beds = Bed::where('bed_status', 0)->get();

            $services2 = Service::get();

        }
        
        $drugs         = Inventory::get();

        $settings  = Settings::first();

        $pending   = Examination::where('status', 0)->orwhere('status',3)->get();


        return view('templates.medical.home',
            compact(
                'pending',
                'examination',
                'appointment',
                'patient',
                'vitals',
                'vitals2',
                'medications',
                'drugs',
                'diagnosis',
                'immunizations',
                'therapies',
                'procedures',
                'histories',
                'allergies',
                'labs',
                'services',
                'settings',
                'patient_return',
                'inpatients',
                'wards',
                'beds',
                'services2'
                ));
    }

    public function exportPDF(Request $request)
    {
        $examination   = Examination::where('status', 1)->where('from_user', $request->user()->id)->first();

        $vitals=0;
        if($examination){
            $appointment_id = $examination->appointment_id;

            $patient = Patient::where('id', $examination->on_patient)->first();
            $on_patient = $examination->on_patient;
            //Get vitals records
            $vitals = Vital::where('on_patient', $on_patient)->paginate(10);

            $vitals2 = Vitals2::where('on_patient', $on_patient)->paginate(10);

            //Get medications to display on medical profile
            $medications = Medication::where('on_patient', $on_patient)->paginate(10, ['*'], 'medications' );

            //Get diagnosis to display on the medical profile
            $diagnosis = Diagnosis::where('on_patient', $on_patient)->paginate(10, ['*'], 'diagnosis');

            //Get immunizations to display on the medical profile
            $immunizations = Immunization::where('on_patient', $on_patient)->paginate(10, ['*'], 'immunizations');

            //Get therapies to display on the medical profile
            $therapies = Therapy::where('on_patient', $on_patient)->paginate(10, ['*'], 'therapies');

            //Get procedures to display on the medical profile
            $procedures = Procedure::where('on_patient', $on_patient)->paginate(10, ['*'], 'procedures');

            //Get histories to display on the medical profile
            $histories = History::where('on_patient', $on_patient)->paginate(10, ['*'], 'histories');

            //Get allergies to display on the medical profile
            $allergies = Allergy::where('on_patient', $on_patient)->paginate(10, ['*'], 'allergies');

            //Get lab records to display on the medical profile
            $labs = Lab::where('on_patient', $on_patient)->paginate(10, ['*'], 'labs');

            $appointment = Appointment::where('id', $appointment_id)->first();
            $service_id  = $appointment->value('service_id');

            $service        = Service::where('id', $service_id)->first();
            $provider_id    = $service->provider_id;

            $services = Service::where('provider_id', $provider_id)->get();

            //Meant to check whether the patient will come back to the doctor
            $patient_return = Lab::where('on_patient',$on_patient)->where('status', 1)->first();

        }

        $drugs         = Inventory::get();
        $settings  = Settings::first();

        $pending   = Examination::where('status', 0)->orwhere('status',3)->get();
        $pdf = PDF::loadView('templates.medical.medical-profile',
            compact(
                'pending',
                'examination',
                'appointment',
                'patient',
                'vitals',
                'vitals2',
                'medications',
                'drugs',
                'diagnosis',
                'immunizations',
                'therapies',
                'procedures',
                'histories',
                'allergies',
                'labs',
                'services',
                'settings',
                'patient_return'
                ));

        return $pdf->download($patient->first_name.' '. $patient->last_name .' ('. $patient->med_id .') Medical Report.pdf');
    }

    public function exportPatient(Request $request, $id)
    {
        $patient   = Patient::where('id', $id)->first();

        $vitals=0;
        if($patient){

            $on_patient = $patient->id;
            //Get vitals records
            $vitals = Vital::where('on_patient', $on_patient)->paginate(10);

            $vitals2 = Vitals2::where('on_patient', $on_patient)->paginate(10);

            //Get medications to display on medical profile
            $medications = Medication::where('on_patient', $on_patient)->paginate(10, ['*'], 'medications' );

            //Get diagnosis to display on the medical profile
            $diagnosis = Diagnosis::where('on_patient', $on_patient)->paginate(10, ['*'], 'diagnosis');

            //Get immunizations to display on the medical profile
            $immunizations = Immunization::where('on_patient', $on_patient)->paginate(10, ['*'], 'immunizations');

            //Get therapies to display on the medical profile
            $therapies = Therapy::where('on_patient', $on_patient)->paginate(10, ['*'], 'therapies');

            //Get procedures to display on the medical profile
            $procedures = Procedure::where('on_patient', $on_patient)->paginate(10, ['*'], 'procedures');

            //Get histories to display on the medical profile
            $histories = History::where('on_patient', $on_patient)->paginate(10, ['*'], 'histories');

            //Get allergies to display on the medical profile
            $allergies = Allergy::where('on_patient', $on_patient)->paginate(10, ['*'], 'allergies');

            //Get lab records to display on the medical profile
            $labs = Lab::where('on_patient', $on_patient)->paginate(10, ['*'], 'labs');

            $service_id  = $appointment->value('service_id');

            $service        = Service::where('id', $service_id)->first();
            $provider_id    = $service->provider_id;

            $services = Service::where('provider_id', $provider_id)->get();

            //Meant to check whether the patient will come back to the doctor
            $patient_return = Lab::where('on_patient',$on_patient)->where('status', 1)->first();

        }

        $drugs         = Inventory::get();
        $settings  = Settings::first();

        $pending   = Examination::where('status', 0)->orwhere('status',3)->get();
        $pdf = PDF::loadView('templates.medical.medical-profile',
            compact(
                'pending',
                'appointment',
                'patient',
                'vitals',
                'vitals2',
                'medications',
                'drugs',
                'diagnosis',
                'immunizations',
                'therapies',
                'procedures',
                'histories',
                'allergies',
                'labs',
                'services',
                'settings',
                'patient_return'
                ));

        return $pdf->download($patient->first_name.' '. $patient->last_name .' ('. $patient->med_id .') Medical Report.pdf');
    }

    public function exportInvoice(Request $request)
    {   
        $payment_id  = $request->input('payment_id');

        $payment  = Payment::where('id', $payment_id)->first();
        $payments = Payment::orderby('created_at', 'desc')->get();
        $settings = Settings::first();

        $pdf = PDF::loadView('templates.reports.accounts.patients-invoice-export',
            compact(
                'payment',
                'payments',
                'settings'
                ));

        return $pdf->download($payment->patient->first_name.' '. $payment->patient->last_name .' ('. $payment->patient->med_id .') Invoice Report.pdf');
    }

    public function exportAllPayments(Request $request)
    {
        $payment_method_id = $request->input('payment_method_id');

        $provider = Provider::where('id', $payment_method_id)->first();

        $payments = Payment::where('provider_id', $provider->id)->get();

        $settings = Settings::first();

        $report = 'Payment Report - '. $provider->name;

        $pdf = PDF::loadView('templates.reports.accounts.payments-reports',
            compact(
                'payments',
                'settings',
                'report'
                ));

        return $pdf->download($provider->name.' Report.pdf');
    }

    public function exportMonthlyPayments(Request $request)
    {
        $payment_method_id = $request->input('payment_method_id');

        $month = $request->input('month');
        $date = new carbon($month);
        $month = Carbon::parse($date)->format('m');
        $year = Carbon::parse($date)->format('Y');

        $provider = Provider::where('id', $payment_method_id)->first();

        $payments = Payment::where('provider_id', $provider->id)->whereRaw('extract(month from created_at) = ?', [$month])->whereRaw('extract(year from created_at) = ?', [$year])->get();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('F Y');

        $report = $date .', Payment Report: '. $provider->name;

        $pdf = PDF::loadView('templates.reports.accounts.payments-reports',
            compact(
                'payments',
                'settings',
                'report'
                ));

        return $pdf->download($provider->name.' Report.pdf');
    }

    public function exportDailyPayments(Request $request)
    {
        $payment_method_id = $request->input('payment_method_id');

        $date = $request->input('date');
        $date = new carbon($date);

        $provider = Provider::where('id', $payment_method_id)->first();

        $payments = Payment::where('provider_id', $provider->id)->whereDate('created_at', '=' ,$date)->get();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('jS F Y');

        $report = $date .' Payment Report: '. $provider->name;

        $pdf = PDF::loadView('templates.reports.accounts.payments-reports',
            compact(
                'payments',
                'settings',
                'report'
                ));

        return $pdf->download($provider->name.' Report.pdf');
    }
}
