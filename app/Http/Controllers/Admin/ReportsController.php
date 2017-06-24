<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Report;
use App\Activity;
use App\User;
use App\Role;

class ReportsController extends Controller
{
    public function getReports()
    {
    	$reports = Report::get();

        $users = User::orderBy('full_name', 'asc')->get();

    	return view('templates.admin.reports', compact('reports', 'users'));
    }

    public function updateReports(Request $request, $id)
    {

        $from_user = $request->user()->id;

        $report = $request->input('status');

        //If input checked, null is returned else 0 is returned
        if($report===null)
        {
            Report::where('id', $id)->update(['status' => 0]);
        }
        else{
            Report::where('id', $id)->update(['status' => 1]);
        }
        
        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " updated a report.";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        return redirect()->route('admin-reports')->with('success', 'The report has been updated successfully.');
    }

    public function addEmail(Request $request)
    {   
        $this->validate($request, [
                'user_id'              => 'required',
                'report_id'            => 'required',
        ]);

        $user_id       = $request->input('user_id');
        $report_id     = $request->input('report_id');

        $accountantReport     = Report::whereName('accountant')->first();
        $pharmacyReport       = Report::whereName('pharmacy')->first();
        $receptionReport      = Report::whereName('reception')->first();
        $triageReport         = Report::whereName('triage')->first();
        $examinationReport    = Report::whereName('examination')->first();
        $laboratoryReport     = Report::whereName('laboratory')->first();
        $inpatientReport      = Report::whereName('inpatient')->first();
        $administratorReport  = Report::whereName('administrator')->first();

        $user   = User::where('id', $user_id)->first();
        $report = Report::where('id', $report_id)->first();

        if($report->name=="administrator")
        {
            $user->assignReport($administratorReport);
        }
        if($report->name=="inpatient")
        {
            $user->assignReport($inpatientReport);
        }
        if($report->name=="laboratory")
        {
            $user->assignReport($laboratoryReport);
        }
        if($report->name=="examination")
        {
            $user->assignReport($examinationReport);
        }
        if($report->name=="triage")
        {
            $user->assignReport($triageReport);
        }
        if($report->name=="reception")
        {
            $user->assignReport($receptionReport);
        }
        if($report->name=="pharmacy")
        {
            $user->assignReport($pharmacyReport);
        }
        if($report->name=="accountant")
        {
            $user->assignReport($accountantReport);
        }

        return redirect()->route('admin-reports')->with('success', 'The email has been added to the automated report successfully.');
    }

    public function removeEmail(Request $request)
    {
        $this->validate($request, [
                'report_id'   => 'required',
                'user_id'     => 'required'
        ]);

        $report_id = $request->input('report_id');
        $user_id   = $request->input('user_id');

        $user        = User::whereId($user_id)->first();
        $report      = Report::whereId($report_id)->first();

        $accountantReport     = Report::whereName('accountant')->first();
        $pharmacyReport       = Report::whereName('pharmacy')->first();
        $receptionReport      = Report::whereName('reception')->first();
        $triageReport         = Report::whereName('triage')->first();
        $examinationReport    = Report::whereName('examination')->first();
        $laboratoryReport     = Report::whereName('laboratory')->first();
        $inpatientReport      = Report::whereName('inpatient')->first();
        $administratorReport  = Report::whereName('administrator')->first();

        if($report->name=="administrator")
        {
            $user->removeReport($administratorReport);
        }
        if($report->name=="inpatient")
        {
            $user->removeReport($inpatientReport);
        }
        if($report->name=="laboratory")
        {
            $user->removeReport($laboratoryReport);
        }
        if($report->name=="examination")
        {
            $user->removeReport($examinationReport);
        }
        if($report->name=="triage")
        {
            $user->removeReport($triageReport);
        }
        if($report->name=="reception")
        {
            $user->removeReport($receptionReport);
        }
        if($report->name=="pharmacy")
        {
            $user->removeReport($pharmacyReport);
        }
        if($report->name=="accountant")
        {
            $user->removeReport($accountantReport);
        }
        return redirect()->route('admin-reports')->with('success', 'The email has been removed from the automated report successfully.');
    }
}
