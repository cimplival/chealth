<?php

namespace App\Http\Controllers\Pharmacy;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Dispensation;
use App\Inventory;
use App\Medication;
use App\Payment;
use App\Appointment;
use App\Http\Requests;
use Auth;
use Session;
use DB;
use Carbon\Carbon;
use App\Activity;
use App\Examination;
use App\Settings;
use App\Notification;

class DispensationController extends Controller
{
    public function getHome(Request $request)
    {
    	//Dispensation status = 0 means Not Dispensed, status = 1 means Pending, status = 2 means Dispensed 
        //Dispensation paid = 0 means Not Paid, paid = 1 means Paid

        $dispensations = Dispensation::paginate(10);
        $dispensationsActive = Dispensation::where('status', 0)->get();
        $dispensationsCount  = count($dispensationsActive);
        $user = $request->user()->id;
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

        return view('templates.pharmacy.dashboard', compact(
            'dispensations', 
            'dispensationsCount', 
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

    public function getDispensation()
    {   
        //Dispensation status = 0 means Not Dispensed, status = 1 means Pending, status = 2 means Dispensed 
        //Dispensation paid = 0 means Not Paid, paid = 1 means Paid

    	$dispensations = Dispensation::paginate(10);
        $dispensationsActive = Dispensation::where('status', 0)->get();
        $dispensationsCount  = count($dispensationsActive);
        $drugs               = DB::table('inventories')->get();
        return view('templates.pharmacy.dispensations', compact('dispensations', 'dispensationsCount', 'drugs'));
    }

    public function dispenseDrug($id, Request $request)
    {
        $from_user = $request->user()->id;

        $dispensation = Dispensation::where('id', $id)->first();
        $dispensation->update(['status'=> 1]);
        $dispensation->update(['from_user'=> $from_user]);

        $appointment_id = $dispensation->appointment_id;

        Appointment::where('id', $appointment_id)->update(['status' => 8]);

        $examination = Examination::where('appointment_id', $appointment_id)->first();

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " dispensed the drug " . $dispensation->inventories->drug_name . " of formulation (".$dispensation->inventories->formulation .") for the patient " . $dispensation->patient->first_name . " " . $dispensation->patient->middle_name . " " . $dispensation->patient->last_name ." of " . $dispensation->patient->med_id . ".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " discharged the patient ". $examination->patient->first_name. " " . $examination->patient->middle_name . " " . $examination->patient->last_name . " of ". $examination->patient->med_id. ".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        
        $hospital     = Settings::first();
        $notification = Notification::where('id', 2)->where('status', 1)->first(); 

        if($notification)
        {   
            //Check if internet connection is on and if true send sms
            $response = null;
            system("ping -c 1 google.com", $response);
            if($response == 0)
            {
                $message = "Hello ". $appointment->patient->first_name ." ".$appointment->patient->last_name.". Thank you for visiting us at ". $hospital->name_of_institution .". We hope you loved our care. We wish you quick recovery. Kindly save our contact (". $hospital->phone_no.") for future enquiries if you haven't done so. All the best.";
                SMSProvider::sendMessage($appointment->patient->patient_phone, $message);
                Activity::create(['from_user'=> $from_user,'description'=> "send an sms for appointment."]);
            }
        }

        return redirect()->route('pharmacy-dispensations')->with('success', 'The drug has been dispensed successfully.');
    }

    public function searchDispensations(Request $request)
    {
        $query = $request->input('search');

        $dispensations = Dispensation::whereHas('patient', function ($term) use($query) {
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
        })->orWhereHas('inventories', function ($term) use($query) {
            $term->where('drug_id','LIKE', '%' . $query . '%');
            $term->orwhere('drug_name','LIKE', '%' . $query . '%');
            $term->orwhere('formulation','LIKE', '%' . $query . '%');
            $term->orwhere('description','LIKE', '%' . $query . '%');
            $term->orwhere('quantity','LIKE', '%' . $query . '%');
            $term->orwhere('per_cost','LIKE', '%' . $query . '%');
            $term->orwhere('expiry_date','LIKE', '%' . $query . '%');
            $term->orwhere('from_user','LIKE', '%' . $query . '%');
        })->paginate(10);

        Session::flash('success', 'Search results for "'. $query . '".' );
        
        $dispensationsActive = Dispensation::where('status', 0)->orWhere('status', 1)->get();
        $dispensationsCount  = count($dispensationsActive);

        return view('templates.pharmacy.dispensations', compact('dispensations', 'dispensationsCount'));
    }

}
