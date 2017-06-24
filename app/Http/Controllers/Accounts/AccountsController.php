<?php

namespace App\Http\Controllers\Accounts;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Patient;
use App\Lab;
use App\Service;
use App\Triage;
use App\Insurance;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Appointment;
use App\Dispensation;
use Session;
use Auth;
use App\Activity;
use App\Inventory;
use App\InsurancePlan;
use App\Settings;
use App\Provider;
use Carbon\Carbon;

class AccountsController extends Controller
{
    //GET HOME PAGE
    public function getHome(Request $request)
    {
        $user = $request->user()->id;

        $activities   = Activity::where('from_user', $request->user()->id)->limit(20)->get();
        $payments  = DB::table('payments')->where('status', 0)->get();

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

        return view('templates.accounts.home', compact(
            'payments', 
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

    public function getPayments()
    {   
        $payments = Payment::orderby('created_at', 'desc')->paginate(10);
        $settings  = Settings::first();
        $providers = Provider::get();

        return view('templates.accounts.payments', compact('payments', 'settings', 'providers'));
    }

    public function getInsurancePlans()
    {
        $insurances = InsurancePlan::orderby('created_at', 'desc')->paginate();
        $settings   = Settings::first();
        return view('templates.accounts.insurance-plans', compact('insurances', 'settings'));
    }

    //GET REPORTS
    public function getReports()
    {
        return view('templates.accounts.reports');
    }

    public function confirmPayment(Request $request, $id)
    {
        $payment    = Payment::where('id', $id)->first();
        $from_user  = $request->user()->id;
        $status     = Appointment::where('id', $payment->appointment_id)->value('status');

        if ($status==1)
        {
            Appointment::where('id', $payment->appointment_id)->update(['status' => 2]);
            $payment->update(['status'=> 1]);

            Triage::create([
                'on_patient'          => $payment->on_patient,
                'appointment_id'      => $payment->appointment_id,
                'service_id'          => $payment->service_id, 
                'status'              => 0,
                'from_user'           => $from_user,
                ]);

            ////////// Activity Log/////////////
            $from_user   = $request->user()->id;
            $description = " confirmed the ". $payment->service->service_name . " payment for ". $payment->patient->first_name. " " . $payment->patient->middle_name . " " . $payment->patient->last_name . " of Med ID: ". $payment->patient->med_id. ".";
            Activity::create(['from_user'=> $from_user,'description'=> $description]);
            ///////////////////////////////////

            return redirect()->route('accounts-payments')->with('success', 'The payment has been completed successfully.');
        } 

        if($status==10) 
        {
            Appointment::where('id', $payment->appointment_id)->update(['status' => 5]);
            $payment->update(['status'=> 1]);

            //Need to add a lab_field to appointment table
            Lab::where('appointment_id', $payment->appointment_id)->update(['status'=> 1]);

            ////////// Activity Log/////////////
            $from_user   = $request->user()->id;
            $description = " confirmed the ". $payment->service->service_name . " payment for ". $payment->patient->first_name. " " . $payment->patient->middle_name . " " . $payment->patient->last_name . " of Med ID: ". $payment->patient->med_id. ".";
            Activity::create(['from_user'=> $from_user,'description'=> $description]);
            ///////////////////////////////////

            return redirect()->route('accounts-payments')->with('success', 'The lab payment has been completed successfully.');

        } 

        if($status==9) {

            Appointment::where('id', $payment->appointment_id)->update(['status' => 6]);
            $payment->update(['status'=> 1]);
            Dispensation::where('appointment_id', $payment->appointment_id)->update(['paid'=> 1]); 

            ////////// Activity Log/////////////
            $from_user   = $request->user()->id;
            $description = " confirmed the ". $payment->service->service_name . " payment for ". $payment->patient->first_name. " " . $payment->patient->middle_name . " " . $payment->patient->last_name . " of Med ID: ". $payment->patient->med_id. ".";
            Activity::create(['from_user'=> $from_user,'description'=> $description]);
            ///////////////////////////////////

            return redirect()->route('accounts-payments')->with('success', 'The drug payment has been completed successfully.');
        }

        if ($status==11)
        {
            Appointment::where('id', $payment->appointment_id)->update(['status' => 2]);
            $payment->update(['status'=> 1]);

            Triage::create([
                'on_patient'          => $payment->on_patient,
                'appointment_id'      => $payment->appointment_id,
                'service_id'          => $payment->service_id, 
                'status'              => 0,
                'from_user'           => $from_user,
                ]);

            ////////// Activity Log/////////////
            $from_user   = $request->user()->id;
            $description = " confirmed the ". $payment->service->service_name . " payment for ". $payment->patient->first_name. " " . $payment->patient->middle_name . " " . $payment->patient->last_name . " of Med ID: ". $payment->patient->med_id. ".";
            Activity::create(['from_user'=> $from_user,'description'=> $description]);
            ///////////////////////////////////

            return redirect()->route('accounts-payments')->with('success', 'The Medical Certificate payment has been completed successfully.');
        }

        if ($status==12) //Pay for Inpatient
        {
            Appointment::where('id', $payment->appointment_id)->update(['status' => 7]);
            $payment->update(['status'=> 1]);

            Triage::create([
                'on_patient'          => $payment->on_patient,
                'appointment_id'      => $payment->appointment_id,
                'service_id'          => $payment->service_id, 
                'status'              => 0,
                'from_user'           => $from_user,
                ]);

            ////////// Activity Log/////////////
            $from_user   = $request->user()->id;
            $description = " confirmed the ". $payment->service->service_name . " payment for ". $payment->patient->first_name. " " . $payment->patient->middle_name . " " . $payment->patient->last_name . " of Med ID: ". $payment->patient->med_id. ".";
            Activity::create(['from_user'=> $from_user,'description'=> $description]);
            ///////////////////////////////////

            return redirect()->route('accounts-payments')->with('success', 'The Medical Certificate payment has been completed successfully.');
        } 
    }

    public function searchPayment(Request $request)
    {
        $query = $request->input('search');

        $payments = Payment::where('cost', 'LIKE', '%' . $query . '%')
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
        })->orWhereHas('appointment', function ($term) use($query) {
            $term->orwhere('from_user','LIKE', '%' . $query . '%');
        })->orWhereHas('service', function ($term) use($query) {
            $term->where('service_name','LIKE', '%' . $query . '%');
            $term->orwhere('cost','LIKE', '%' . $query . '%');
            $term->orwhere('from_user','LIKE', '%' . $query . '%');
        })->paginate(10);

        $user = $request->user()->id;

        $settings  = Settings::first();
        $providers = Provider::get();

        Session::flash('success', 'There were ' . count($payments) .' search results.' );

        return view('templates.accounts.payments', compact('payments' , 'user', 'settings', 'providers'));

    }

    public function updatePayment($id, Request $request)
    {
        $this->validate($request, [
            'status'              => 'required'
            ]);

        $updatedBy = $request->user()->id;

        $payment = Payment::where('id', $id)->first();
        $input = $request->all();
        $payment->fill($input)->save();

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " updated payment for ". $payment->patient->first_name. " " . $payment->patient->middle_name . " " . $payment->patient->last_name . " of Med ID: ". $payment->patient->med_id. ".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        return redirect()->route('accounts-payments')->with('success', 'The payment has been updated successfully.');
    }

    public function searchDrugs(Request $request)
    {
        $query = $request->input('search');

        $inventories = Inventory::where('drug_id', 'LIKE', '%' . $query . '%')
        ->orWhere('drug_name', 'LIKE', '%' . $query . '%')
        ->orWhere('formulation', 'LIKE', '%' . $query . '%')
        ->orWhere('description', 'LIKE', '%' . $query . '%')
        ->orWhere('quantity', 'LIKE', '%' . $query . '%')
        ->orWhere('per_cost', 'LIKE', '%' . $query . '%')
        ->orWhere('expiry_date', 'LIKE', '%' . $query . '%')
        ->orwhereHas('users', function ($term) use($query) {
            $term->where('full_name','LIKE', '%' . $query . '%');
            $term->orwhere('user_name','LIKE', '%' . $query . '%');
        })->paginate(10);

        Session::flash('success', 'Search results for "'. $query . '".' );

        return view('templates.accounts.drugs-payments', compact('inventories'));
    }
}
