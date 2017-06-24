<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\History;
use App\Examination;
use Carbon\Carbon;
use App\Activity;

class HistoryController extends Controller
{
    public function addHistory(Request $request)
    {

    	$this->validate($request, [
                'history_name'          => 'required|max:255',
                'history_relationship'  => 'required|max:255',
                'history_notes'         => 'required|max:2000',
                'history_from'          => 'required|max:20',
                'history_to'            => 'required|max:20',
                'history_status'        => 'required|max:20'
        ]);

        $history_from = $request->input('history_from');
        $history_from = new carbon($history_from);

        $history_to = $request->input('history_to');
        $history_to = new carbon($history_to);

        $examination_id = $request->input('examination_id');
        $examination    = Examination::where('id', $examination_id)->first();
        $from_user      = $request->user()->id;

        History::create([
                'appointment_id'  => $examination->appointment_id,
                'on_patient'      => $examination->on_patient,
                'history'       => $request->input('history_name'),
                'relationship'  => $request->input('history_relationship'),
                'notes'         => $request->input('history_notes'),
                'from_date'     => $history_from,
                'to_date'       => $history_to,
                'status'        => $request->input('history_status'),
                'from_user'     => $from_user
        ]);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " added a family or social history for the patient ". $examination->patient->first_name. " " . $examination->patient->middle_name. " " . $examination->patient->last_name . " of ". $examination->patient->med_id.".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

    	return redirect()->route('medical-profile')->with('success', 'The patient\'s history has been added successfully.'); 
    }
}
