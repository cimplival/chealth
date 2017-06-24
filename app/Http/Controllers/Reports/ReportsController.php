<?php

namespace App\Http\Controllers\Reports;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Appointment;
use App\Settings;
use App\Triage;
use App\Examination;
use App\Dispensation;
use App\User;
use PDF;
use App\Lab;
use App\Inpatient;
use App\Activity;

class ReportsController extends Controller
{
    public function exportDailyAppointments(Request $request)
    {
        $date = $request->input('date');
        $date = new carbon($date);

        $appointments = Appointment::whereDate('created_at', '=' ,$date)->get();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('jS F Y');

        $report = $date .' Appointments Report: ';

        $pdf = PDF::loadView('templates.reports.appointments.appointments',
            compact(
                'appointments',
                'settings',
                'report'
                ));

        return $pdf->download('Daily Appointments Report ('.$date.').pdf');
    }

    public function exportMonthlyAppointments(Request $request)
    {
        $month = $request->input('month');
        $date = new carbon($month);

        $month = Carbon::parse($date)->format('m');
        $year = Carbon::parse($date)->format('Y');


        $appointments = Appointment::whereRaw('extract(month from created_at) = ?', [$month])->whereRaw('extract(year from created_at) = ?', [$year])->get();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('F Y');

        $report = $date .', Appointments Report';

        $pdf = PDF::loadView('templates.reports.appointments.appointments',
            compact(
                'appointments',
                'settings',
                'report'
                ));

        return $pdf->download('Monthly Appointment Report ('.$date.').pdf');
    }

    public function exportAllAppointments(Request $request)
    {
        $appointments = Appointment::get();

        $settings = Settings::first();

        $report = 'All Appointments Report';

        $pdf = PDF::loadView('templates.reports.appointments.appointments',
            compact(
                'appointments',
                'settings',
                'report'
                ));

        return $pdf->download('All Appointments Report.pdf');
    }

    public function exportDailyTriages(Request $request)
    {
        $date = $request->input('date');
        $date = new carbon($date);

        $triages = Triage::whereDate('created_at', '=' ,$date)->get();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('jS F Y');

        $report = $date .' Triages Report: ';

        $pdf = PDF::loadView('templates.reports.triage.triage',
            compact(
                'triages',
                'settings',
                'report'
                ));

        return $pdf->download('Daily Triages Report ('.$date.').pdf');
    }

    public function exportMonthlyTriages(Request $request)
    {
        $month = $request->input('month');
        $date = new carbon($month);

        $month = Carbon::parse($date)->format('m');
        $year = Carbon::parse($date)->format('Y');


        $triages = Triage::whereRaw('extract(month from created_at) = ?', [$month])->whereRaw('extract(year from created_at) = ?', [$year])->get();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('F Y');

        $report = $date .', Triages Report';

        $pdf = PDF::loadView('templates.reports.triage.triage',
            compact(
                'triages',
                'settings',
                'report'
                ));

        return $pdf->download('Monthly Triage Report ('.$date.').pdf');
    }

    public function exportAllTriages(Request $request)
    {
        $triages = Triage::get();

        $settings = Settings::first();

        $report = 'All Triages Report';

        $pdf = PDF::loadView('templates.reports.triage.triage',
            compact(
                'triages',
                'settings',
                'report'
                ));

        return $pdf->download('All Triages Report.pdf');
    }

    public function exportDailyDoctorExaminations(Request $request)
    {
        $date = $request->input('date');
        $date = new carbon($date);

        $from_user = $request->user()->id;

        $examinations = Examination::whereDate('created_at', '=' ,$date)->where('from_user', $from_user)->get();

        $user= User::where('id', $from_user)->first();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('jS F Y');

        $report = $user->full_name .' '. $date .' Daily Examinations Report';

        $pdf = PDF::loadView('templates.reports.doctor.examinations',
            compact(
                'examinations',
                'settings',
                'report'
                ));

        return $pdf->download($user->full_name .' Daily Examinations Report ('.$date.').pdf');
    }

    public function exportMonthlyDoctorExaminations(Request $request)
    {
        $month = $request->input('month');
        $date = new carbon($month);

        $from_user = $request->user()->id;

        $month = Carbon::parse($date)->format('m');
        $year = Carbon::parse($date)->format('Y');

        $examinations = Examination::whereRaw('extract(month from created_at) = ?', [$month])->whereRaw('extract(year from created_at) = ?', [$year])->where('from_user', $from_user)->get();

        $user= User::where('id', $from_user)->first();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('F Y');

        $report = $user->full_name .' '. $date .' Monthly Examinations Report';

        $pdf = PDF::loadView('templates.reports.doctor.examinations',
            compact(
                'examinations',
                'settings',
                'report'
                ));

        return $pdf->download($user->full_name . ' Monthly Examinations Report ('.$date.').pdf');
    }

    public function exportAllDoctorExaminations(Request $request)
    {
        $from_user = $request->user()->id;

        $examinations = Examination::get();

        $user= User::where('id', $from_user)->first();

        $settings = Settings::first();

        $report = $user->full_name .' All Examinations Report';

        $pdf = PDF::loadView('templates.reports.doctor.examinations',
            compact(
                'examinations',
                'settings',
                'report'
                ));

        return $pdf->download($user->full_name . ' All Examinations Report.pdf');
    }

    public function exportDailyDispensations(Request $request)
    {
        $date = $request->input('date');
        $date = new carbon($date);

        $dispensations = Dispensation::whereDate('created_at', '=' ,$date)->get();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('jS F Y');

        $report =  $date .' Daily Dispensations Report';

        $pdf = PDF::loadView('templates.reports.pharmacy.dispensations',
            compact(
                'dispensations',
                'settings',
                'report'
                ));

        return $pdf->download('Daily Dispensations Report ('.$date.').pdf');
    }

    public function exportMonthlyDispensations(Request $request)
    {
        $month = $request->input('month');
        $date = new carbon($month);

        $month = Carbon::parse($date)->format('m');
        $year = Carbon::parse($date)->format('Y');

        $dispensations = Dispensation::whereRaw('extract(month from created_at) = ?', [$month])->whereRaw('extract(year from created_at) = ?', [$year])->get();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('F Y');

        $report = $date .' Monthly Dispensations Report';

        $pdf = PDF::loadView('templates.reports.pharmacy.dispensations',
            compact(
                'dispensations',
                'settings',
                'report'
                ));

        return $pdf->download('Monthly Dispensations Report ('.$date.').pdf');
    }

    public function exportAllDispensations(Request $request)
    {
        $dispensations = Dispensation::get();

        $settings = Settings::first();

        $report = 'All Dispensations Report';

        $pdf = PDF::loadView('templates.reports.pharmacy.dispensations',
            compact(
                'dispensations',
                'settings',
                'report'
                ));

        return $pdf->download('All Dispensations Report.pdf');
    }

    public function exportDailyLabs(Request $request)
    {
        $date = $request->input('date');
        $date = new carbon($date);

        $labs = Lab::whereDate('created_at', '=' ,$date)->get();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('jS F Y');

        $report =  $date .' Daily Lab Report';

        $pdf = PDF::loadView('templates.reports.labs.labs',
            compact(
                'labs',
                'settings',
                'report'
                ));

        return $pdf->download('Daily Labs Report ('.$date.').pdf');
    }

    public function exportMonthlyLabs(Request $request)
    {
        $month = $request->input('month');
        $date = new carbon($month);

        $month = Carbon::parse($date)->format('m');
        $year = Carbon::parse($date)->format('Y');

        $labs = Lab::whereRaw('extract(month from created_at) = ?', [$month])->whereRaw('extract(year from created_at) = ?', [$year])->get();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('F Y');

        $report = $date .' Monthly Lab Report';

        $pdf = PDF::loadView('templates.reports.labs.labs',
            compact(
                'labs',
                'settings',
                'report'
                ));

        return $pdf->download('Monthly Labs Report ('.$date.').pdf');
    }

    public function exportAllLabs(Request $request)
    {
        $labs = Lab::get();

        $settings = Settings::first();

        $report = 'All Lab Report';

        $pdf = PDF::loadView('templates.reports.labs.labs',
            compact(
                'labs',
                'settings',
                'report'
                ));

        return $pdf->download('All Labs Report.pdf');
    }

    public function exportDailyInpatient(Request $request)
    {
        $date = $request->input('date');
        $date = new carbon($date);

        $inpatients = Inpatient::whereDate('created_at', '=' ,$date)->get();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('jS F Y');

        $report =  $date .' Daily Inpatient Report';

        $pdf = PDF::loadView('templates.reports.inpatients.inpatients',
            compact(
                'inpatients',
                'settings',
                'report'
                ));

        return $pdf->download('Daily Inpatient Report ('.$date.').pdf');
    }

    public function exportMonthlyInpatient(Request $request)
    {
        $month = $request->input('month');
        $date = new carbon($month);

        $month = Carbon::parse($date)->format('m');
        $year = Carbon::parse($date)->format('Y');

        $inpatients = Inpatient::whereRaw('extract(month from created_at) = ?', [$month])->whereRaw('extract(year from created_at) = ?', [$year])->get();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('F Y');

        $report = $date .' Monthly Inpatient Report';

        $pdf = PDF::loadView('templates.reports.inpatients.inpatients',
            compact(
                'inpatients',
                'settings',
                'report'
                ));

        return $pdf->download('Monthly Inpatient Report ('.$date.').pdf');
    }

    public function exportAllInpatient(Request $request)
    {
        $inpatients = Inpatient::get();

        $settings = Settings::first();

        $report = 'All Inpatient Report';

        $pdf = PDF::loadView('templates.reports.inpatients.inpatients',
            compact(
                'inpatients',
                'settings',
                'report'
                ));

        return $pdf->download('All Inpatient Report.pdf');
    }

    public function exportDailyActivity(Request $request)
    {
        $date = $request->input('date');
        $date = new carbon($date);

        $from_user = $request->user()->id;

        $activities = Activity::whereDate('created_at', '=' ,$date)->where('from_user', $from_user)->get();

        $user = User::where('id', $from_user)->first();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('jS F Y');

        $report = $user->full_name .' '. $date .' Daily Activity Report';

        $pdf = PDF::loadView('templates.reports.activities.activities',
            compact(
                'activities',
                'settings',
                'report'
                ));

        return $pdf->download($user->full_name .' Daily Activity Report ('.$date.').pdf');
    }

    public function exportMonthlyActivity(Request $request)
    {
        $month = $request->input('month');
        $date = new carbon($month);

        $from_user = $request->user()->id;

        $month = Carbon::parse($date)->format('m');
        $year = Carbon::parse($date)->format('Y');

        $activities = Activity::whereRaw('extract(month from created_at) = ?', [$month])->whereRaw('extract(year from created_at) = ?', [$year])->where('from_user', $from_user)->get();

        $user= User::where('id', $from_user)->first();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('F Y');

        $report = $user->full_name .' '. $date .' Monthly Activity Report';

        $pdf = PDF::loadView('templates.reports.activities.activities',
            compact(
                'activities',
                'settings',
                'report'
                ));

        return $pdf->download($user->full_name . ' Monthly Activity Report ('.$date.').pdf');
    }

    public function exportDailyUserActivity(Request $request)
    {
        $date = $request->input('date');
        $date = new carbon($date);

        $user_id    = $request->input('user_id');

        $activities = Activity::whereDate('created_at', '=' ,$date)->where('from_user', $user_id)->get();

        $user       = User::where('id', $user_id)->first();

        $settings   = Settings::first();

        $date       = Carbon::parse($date)->format('jS F Y');

        $report     = $user->full_name .' '. $date .' Daily Activity Report';

        $pdf        = PDF::loadView('templates.reports.activities.activities',
            compact(
                'activities',
                'settings',
                'report'
                ));

        return $pdf->download($user->full_name .' Daily User Activity Report ('.$date.').pdf');
    }

    public function exportMonthlyUserActivity(Request $request)
    {
        $month = $request->input('month');
        $date = new carbon($month);

        $user_id    = $request->input('user_id');
        
        $month = Carbon::parse($date)->format('m');
        $year = Carbon::parse($date)->format('Y');

        $activities = Activity::whereRaw('extract(month from created_at) = ?', [$month])->whereRaw('extract(year from created_at) = ?', [$year])->where('from_user', $user_id)->get();

        $user= User::where('id', $user_id)->first();

        $settings = Settings::first();

        $date = Carbon::parse($date)->format('F Y');

        $report = $user->full_name .' '. $date .' Monthly User Activity Report';

        $pdf = PDF::loadView('templates.reports.activities.activities',
            compact(
                'activities',
                'settings',
                'report'
                ));

        return $pdf->download($user->full_name . ' Monthly User Activity Report ('.$date.').pdf');
    }
}
