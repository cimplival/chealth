<?php

namespace App\Http\Controllers\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Insurance;
use App\Payment;
use App\Triage;
use App\Appointment;
use App\Http\Requests;
use Session;
use App\Activity;
use App\InsurancePlan;
use App\Settings;

class InsuranceController extends Controller
{
    //GET INSURANCE
    public function getInsurance()
    {
        $payments   = Payment::where('status', 0)->get();
        $insurances = Insurance::orderby('created_at', 'desc')->paginate(10);
        $settings   = Settings::get();
        return view('templates.accounts.insurance', compact('insurances', 'payments', 'settings'));
    }

    public function createInsurance(Request $request)
    {
    	$this->validate($request, [
            'insurance_provider'          => 'required',
            'insurance_identifier'        => 'required'
            ]);


    	//Get patient details
    	$payment_id                   = $request->input('payment_id');
        $insurance_provider           = $request->input('insurance_provider');
        $insurance_identifier         = $request->input('insurance_identifier');

        $payment                      = Payment::where('id', $payment_id)->first();
        $from_user 				      = $request->user()->id;

        Insurance::create([
            'payment_id'           => $payment_id,
            'on_patient'           => $payment->on_patient,
            'appointment_id'       => $payment->appointment_id,
            'insurance_identifier' => $insurance_identifier,
            'insurance_provider'   => $insurance_provider,
            'service_id'           => $payment->service_id,
            'cost'                 => $payment->cost,
            'from_user'            => $from_user,
            ]);

        Triage::create([
            'on_patient'          => $payment->on_patient,
            'appointment_id'      => $payment->appointment_id,
            'service_id'          => $payment->service_id, 
            'status'              => 0,
            'from_user'           => $from_user,
            ]);

        Appointment::where('id', $payment->appointment_id)->update(['status' => 2]);

        $insurance_id = Insurance::where('payment_id', $payment_id)->value('id');
        
        $payment->update(['status'    => 1]);
        $payment->update(['insurance_id' => $insurance_id]);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " created an insurance record, a triage record, updated appointment status and changed payment status for ". $payment->patient->first_name. " " . $payment->patient->middle_name . " " . $payment->patient->last_name . " of Med ID: ". $payment->patient->med_id. ".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        return redirect()->route('accounts-payments')->with('success', 'The Insurance has been created successfully.');
    }

    public function updateInsurance($id, Request $request)
    {
        $this->validate($request, [
            'insurance_provider'             => 'required',
            'insurance_identifier'           => 'required'
            ]);

        $updatedBy = $request->user()->id;

        $insurance = Insurance::where('id', $id)->first();
        $input = $request->all();
        $insurance->fill($input)->save();

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " updated an insurance record for ". $insurance->patient->first_name. " " . $insurance->patient->middle_name . " " . $insurance->patient->last_name . " of Med ID: ". $insurance->patient->med_id. ".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        return redirect()->route('accounts-insurance')->with('success', 'The Insurance payment has been updated successfully.');
    }

    public function searchInsurance(Request $request)
    {
        $query = $request->input('search');

        $insurances = Insurance::where('cost', 'LIKE', '%' . $query . '%')
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
        })->orWhereHas('payment', function ($term) use($query) {
            $term->where('cost','LIKE', '%' . $query . '%');
        })->orWhereHas('service', function ($term) use($query) {
            $term->where('service_name','LIKE', '%' . $query . '%');
            $term->orwhere('cost','LIKE', '%' . $query . '%');
        })->orWhereHas('user', function ($term) use($query) {
            $term->where('full_name','LIKE', '%' . $query . '%');
            $term->orwhere('user_name','LIKE', '%' . $query . '%');
        })->paginate(10);
        
        return view('templates.accounts.insurance', compact('insurances'))->with('success', 'There were ' . count($insurances) .' search results.' );

    }

    public function deleteInsurance(Request $request, $id)
    {
    	$insurance = Insurance::find($id);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " deleted an insurance record for ". $insurance->patient->first_name. " " . $insurance->patient->middle_name . " " . $insurance->patient->last_name . " of Med ID: ". $insurance->patient->med_id. ".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        $patientName = $insurance->patient;
        $insurance->delete();
        return redirect()->route('accounts-insurance')->with('info-insurance', 'You have deleted the insurance payment for '.$patientName .' successfully.');
    }

    public function confirmInsurancePlan(Request $request, $id)
    {
        InsurancePlan::where('id', $id)->update(['confirmed' => 1]);

        return redirect()->route('get-insurance-plans')->with('success', 'You have confirmed the insurance plan successfully.');
    }

    public function searchInsurancePlans(Request $request)
    {
        $query = $request->input('search');

        $insurances = InsurancePlan::where('national_id', 'LIKE', '%' . $query . '%')
        ->orwhere('insurance_identifier', 'LIKE', '%' . $query . '%')   
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
        })->orWhereHas('users', function ($term) use($query) {
            $term->where('full_name','LIKE', '%' . $query . '%');
            $term->orwhere('user_name','LIKE', '%' . $query . '%');
        })->orWhereHas('provider', function ($term) use($query) {
            $term->where('name','LIKE', '%' . $query . '%');
        })->paginate(10);

        return view('templates.accounts.insurance-plans', compact('insurances'))->with('success', 'There were ' . count($insurances) .' search results.' );
    }
}
