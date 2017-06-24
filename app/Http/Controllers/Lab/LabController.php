<?php

namespace App\Http\Controllers\Lab;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Lab;
use App\Appointment;
use App\Examination;
use App\Payment;
use App\Patient;
use App\Service;
use Session;
use DB;
use App\Activity;
use App\Insurance;
use App\InsurancePlan;

class LabController extends Controller
{
    //GET HOME PAGE
    public function getHome()
    {
        return view('templates.lab.home');
    }

    //GET LAB RECORDS
    public function getRecords()
    {
        return view('templates.lab.lab-records');
    }

    //GET PAST RECORDS
    public function getPastRecords()
    {
        return view('templates.lab.past-records');
    }

    public function searchLabRequests(Request $request)
    {
        $query = $request->input('search');

        $labs = Lab::where('id', 'LIKE', '%' . $query . '%')
        ->orWhere('lab_name', 'LIKE', '%' . $query . '%')
        ->orWhere('lab_notes', 'LIKE', '%' . $query . '%')
        ->orWhere('lab_document', 'LIKE', '%' . $query . '%')
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
        })->orwhereHas('user', function ($term) use($query) {
            $term->where('full_name','LIKE', '%' . $query . '%');
            $term->orwhere('user_name','LIKE', '%' . $query . '%');
        })->paginate(10);

        $labs_pending  = Lab::where('status', '!=', 2)->get();

        return view('templates.lab.lab-records', compact('labs', 'labs_pending'))->with('success', 'Search results for "'. $query . '".' );
    }

    public function updateLab(Request $request, $id)
    {
        $lab = Lab::where('id', $id)->first();
        $appointment_id = $lab->appointment_id;
        $lab = $lab->update(['status' => 2]);

        Appointment::where('id', $appointment_id)->update(['status' => 4]);

        $examination = Examination::where('appointment_id', $appointment_id)->first();
        $examination->update(['status' => 3]);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " updated lab for the patient ". $examination->patient->first_name. " " . $examination->patient->middle_name. " " . $examination->patient->last_name . " of ". $examination->patient->med_id.".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        return redirect()->route('lab-records')->with('success', 'The lab record has been updated successfully.');
    }

    public function updateReview(Request $request, $id)
    {
        $this->validate($request, [
            'lab_review'           => 'required|max:255'
            ]);

        $lab_review = $request->input('lab_review');

        $lab = Lab::where('id', $id)->first();
        $lab->update(['lab_review' => $lab_review]);

        $appointment_id = $lab->appointment_id;
        $examination = Examination::where('id', $appointment_id)->first();

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " reviewed lab for the patient ". $examination->patient->first_name. " " . $examination->patient->middle_name. " " . $examination->patient->last_name . " of ". $examination->patient->med_id."  with " . $lab_review. ".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        return redirect()->route('medical-profile')->with('success', 'The lab record has been updated successfully.'); 
    }

    public function addLab(Request $request)
    {
        $this->validate($request, [
            'lab_name'           => 'required|max:255',
            'lab_notes'          => 'required|max:255',
            ]);

        $examination_id          = $request->input('examination_id');
        $lab_name                = $request->input('lab_name');
        $lab_notes               = $request->input('lab_notes');
        $from_user               = $request->user()->id;

        $examination             = Examination::where('id', $examination_id)->first();
        $appointment             = Appointment::where('id', $examination->appointment_id)->first();
        
        $insurance_plan          = InsurancePlan::where('on_patient', $examination->on_patient)->where('confirmed', 1)->first();
        $provider_id             = $insurance_plan->provider_id;
        $service                 = Service::where('provider_id', $provider_id)->where('lab_status', 1)->first();
        $cost            = $service->cost;

        $lab = Lab::create([
            'on_patient'         => $examination->on_patient,
            'appointment_id'     => $examination->appointment_id,
            'lab_name'           => $lab_name,
            'lab_notes'          => $lab_notes,
            'status'             => 0,
            'from_user'          => $from_user
            ]);

        $payment = Payment::create([
            'on_patient'          => $insurance_plan->on_patient,
            'appointment_id'      => $appointment->id,
            'drug_id'             => 0,
            'status'              => 0,
            'cost'                => $cost,
            'service_id'          => $appointment->service_id,
            'insurance_id'        => 0,
            'from_user'           => $from_user,
            ]);

        Appointment::where('id', $examination->appointment_id)->update(['status' => 10]);

        $flash   = 'success';
        $message = 'The lab request has been made successfully. Kindly, direct the patient to the accounts for payment.';

        if($insurance_plan)
        {   
            $insurance_id = $insurance_plan->id;

            $payment->update(['status' => 1]);
            $payment->update(['insurance_id' => $insurance_id]);
            $lab->update(['status'=> 1]);

            Insurance::create([
                'payment_id'           => $payment->id,
                'on_patient'           => $payment->on_patient,
                'appointment_id'       => $payment->appointment_id,
                'insurance_id'         => $insurance_plan->id,
                'service_id'           => $payment->service_id,
                'cost'                 => $cost,
                'status'               => 1,
                'from_user'            => $from_user,
                ]);

            Appointment::where('id', $appointment->id)->update(['status' => 5]);

            $message = 'The lab request has been made successfully. Kindly, direct the patient to the lab for the test.';
        } 

        return redirect()->route('medical-profile')->with($flash, $message);
    }
}
