<?php

namespace App\Http\Controllers\Nurse;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Inpatient;
use App\Ward;
use App\Bed;
use App\Activity;
use App\Appointment;
use App\InsurancePlan;
use App\Insurance;
use App\Service;
use App\Payment;

class InpatientController extends Controller
{
	public function getInpatient()
	{
		$inpatients = Inpatient::paginate(10);

		return view('templates.nurse.inpatient', compact('inpatients'));
	}

	public function dischargePatient(Request $request, $id)
	{
		$inpatient = Inpatient::where('id', $id)->update(['status' => 1]);

		Appointment::where('id', $inpatient->appointment_id)->update(['status' => 8]);

		$bed = Bed::where('id', $inpatient->bed_id)->update(['bed_status' => 0]);

		$ward = Ward::where('id', $inpatient->ward_id)->update(['ward_status' => 1]);

		return redirect()->route('get-inpatient')->with('success', 'The patient has been discharged successfully.'); 
	}

	public function deleteInpatient(Request $request, $id)
	{
		$inpatient = Inpatient::find($id);

		$bed = Bed::where('id', $inpatient->bed_id)->update(['bed_status' => 0]);

		$ward = Ward::where('id', $inpatient->ward_id)->update(['ward_status' => 1]);

		////////// Activity Log/////////////
		$from_user   = $request->user()->id;
		$description = " deleted inpatient record for ". $inpatient->patient->first_name. " " . $inpatient->patient->middle_name. " " . $inpatient->patient->last_name . " of ". $inpatient->patient->med_id.".";
		Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

		$inpatient->delete();

		return redirect()->route('get-inpatient')->with('success', 'The inpatient record has been deleted successfully.');	
	}

	public function createInpatient(Request $request)
	{
		$from_user   = $request->user()->id;
		$service = Service::where('id', 5)->first(); //service 5 is inpatient
		$service_id = $service->id;
		$cost = $service->cost;
		$provider_id = $service->provider_id;

		$ward_id = $request->input('ward_id');
		$bed_id = $request->input('bed_id');
		$patient_id = $request->input('patient_id');
		$appointment_id = $request->input('appointment_id');

		Bed::where('id', $bed_id)->update(['bed_status' => 0]);
		Ward::where('id', $ward_id)->update(['ward_status' => 1]);

		$inpatient = Inpatient::create([
			'patient_id'       => $patient_id,
			'appointment_id'   => $appointment_id,
			'ward_id'          => $ward_id,
			'bed_id'           => $bed_id,
			'status'           => 0,
			'from_user'        => $from_user
			]);

		$insurance_id = 0; 


		$insurance_plan = InsurancePlan::where('provider_id', $provider_id)->where('on_patient', $patient_id)->first();


		if($provider_id>1)
		{
			$insurance = Insurance::create([
				'payment_id'           => $payment_id,
				'on_patient'           => $patient_id,
				'appointment_id'       => $appointment_id,
				'insurance_id'         => $insurance_plan->id,
				'service_id'           => $payment->service_id,
				'cost'                 => $cost,
				'status'               => 1,
				'from_user'            => $from_user,
				]);

			$payment = Payment::create([
				'on_patient'          => $patient_id,
				'appointment_id'      => $appointment_id,
				'drug_id'             => 0,
				'status'              => 0,
				'cost'                => $cost,
				'service_id'          => $service_id,
				'insurance_id'        => $insurance_id,
				'provider_id'         => $provider_id,
				'from_user'           => $from_user,
				]);

		} else {
			$payment = Payment::create([
				'on_patient'          => $patient_id,
				'appointment_id'      => $appointment_id,
				'drug_id'             => 0,
				'status'              => 0,
				'cost'                => $cost,
				'service_id'          => $service_id,
				'insurance_id'        => $insurance_id,
				'provider_id'         => $provider_id,
				'from_user'           => $from_user,
				]);
		}

		$bed = Bed::where('id', $bed_id)->update(['bed_status' => 1]);

		$beds_in_ward = count(Bed::where('ward_no', $ward_id)->where('bed_status', 0)->get());

		if($beds_in_ward==0){
			Ward::where('id', $ward_id)->update(['ward_status' => 2]);
		}

		////////// Activity Log/////////////

		$description = " created inpatient record for ". $inpatient->patient->first_name. " " . $inpatient->patient->middle_name. " " . $inpatient->patient->last_name . " of ". $inpatient->patient->med_id.".";
		Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

		return redirect()->route('medical-profile')->with('success', 'The inpatient record has been created successfully.');	
	}

	public function searchInpatient(Request $request){

		$query = $request->input('search');

		$inpatients = Inpatient::where('ward_id', 'LIKE', '%' . $query . '%')
		->orWhereHas('patient', function ($term) use($query) {
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
		})->orwhereHas('bed', function ($term) use($query) {
			$term->where('bed_no','LIKE', '%' . $query . '%');
			$term->orwhere('bed_notes','LIKE', '%' . $query . '%');
		})->paginate(10);

		$wards = Ward::paginate(10);

		$beds = Bed::paginate(10);

		return view('templates.nurse.inpatient', compact('inpatients', 'wards', 'beds'))->with('success', 'There were ' . count($beds) .' search results for "'. $query . '".' );

	}
}
