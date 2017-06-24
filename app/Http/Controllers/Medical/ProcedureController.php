<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Procedure;
use App\Examination;
use Session;
use Carbon\Carbon;
use App\Activity;

class ProcedureController extends Controller
{
    public function addProcedure(Request $request)
    {

    	$this->validate($request, [
                'procedure_name'    => 'required|max:255',
                'procedure_type'    => 'required|max:255',
                'procedure_notes'   => 'required|max:2000',
                'from_date'         => 'required|max:20',
                'to_date'           => 'required|max:20',
        ]);

        $from_date = $request->input('from_date');
        $from_date = new carbon($from_date);

        $to_date = $request->input('to_date');
        $to_date = new carbon($to_date);

        $difference = ($to_date->diff($from_date)->days < 1)
                     ? 'same day'
                     : $to_date->diffInDays($from_date);

        $examination_id = $request->input('examination_id');
        $examination    = Examination::where('id', $examination_id)->first();
        $from_user      = $request->user()->id;

        Procedure::create([
                'appointment_id'    => $examination->appointment_id,
                'on_patient'        => $examination->on_patient,
                'procedure_name'    => $request->input('procedure_name'),
                'procedure_type'    => $request->input('procedure_type'),
                'procedure_notes'   => $request->input('procedure_notes'),
                'from_date'         => $from_date,
                'to_date'           => $to_date,
                'duration'          => $difference,
                'from_user'         => $from_user
        ]);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " added a procedure, surgery, hospitalization etc. for the patient ". $examination->patient->first_name. " " . $examination->patient->middle_name. " " . $examination->patient->last_name . " of ". $examination->patient->med_id.".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

    	return redirect()->route('medical-profile')->with('success', 'The patient\'s procedure, surgery, hospitalization etc. has been added successfully.');; 
    }
}
