<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Lab;
use App\Payment;
use App\Examination;
use App\Service;
use App\Appointment;
use Auth;
use Session;
use DB;
use App\Activity;
use Carbon\Carbon;

class LabController extends Controller
{
    //Get lab records
    public function getRecords()
    {
        $labs_pending  = Lab::where('status', 1)->get();
        $labs          = Lab::paginate(10);
        
        return view('templates.lab.lab-records', compact('labs_pending', 'labs'));
    }

    //Get lab home
    public function getHome(Request $request)
    {
        $labs_pending  = Lab::where('status', '!=', 2)->get();
        $user = $request->user()->id;
        $activities   = Activity::where('from_user', $request->user()->id)->limit(20)->get();

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

        return view('templates.lab.home', compact(
            'activities', 
            'labs_pending', 
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

    //Get past records
    public function getPastRecords()
    {
        return view('templates.lab.past-records');
    }

    public function addLab(Request $request)
    {
        $this->validate($request, [
            'lab_name'           => 'required|max:255',
            'lab_notes'          => 'required|max:255',
            'service_identifier' => 'required'
            ]);

        $examination_id          = $request->input('examination_id');
        $lab_name                = $request->input('lab_name');
        $lab_notes               = $request->input('lab_notes');
        $service_id              = $request->input('service_identifier');
        $from_user               = $request->user()->id;

        $examination             = Examination::where('id', $examination_id)->first();

        $lab = Lab::create([
            'on_patient'         => $examination->on_patient,
            'appointment_id'     => $examination->appointment_id,
            'lab_name'           => $lab_name,
            'lab_notes'          => $lab_notes,
            'status'             => 0,
            'from_user'          => $from_user
            ]);
        
        Payment::create([
            'on_patient'          => $lab->on_patient,
            'appointment_id'      => $lab->appointment_id,
            'cost'                => $service->cost,
            'service_id'          => 5,
            'provider_id'         => $service->provider_id,
            'from_user'           => $from_user,
            ]);

        Appointment::where('id', $examination->appointment_id)->update(['status' => 10]);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " made a lab request for the patient ". $examination->patient->first_name. " " . $examination->patient->middle_name. " " . $examination->patient->last_name . " of ". $examination->patient->med_id.".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        return redirect()->route('medical-profile')->with('success', 'The lab request has been made successfully.');
    }
}
