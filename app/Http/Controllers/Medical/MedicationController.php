<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use App\Medication;
use App\Dispensation;
use App\Vital;
use App\Payment;
use App\Inventory;
use App\Appointment;
use App\Examination;
use Carbon\Carbon;
use App\Service;
use App\InsurancePlan;
use App\Insurance;

class MedicationController extends Controller
{
    public function prescribeMedication(Request $request)
    {
    	$this->validate($request, [
            'inventory_id'        => 'required|max:256',
            'quantity_consumed'   => 'required|numeric|max:20',
            'times_a_day'         => 'required|numeric|max:20',
            'no_of_days'          => 'required|numeric|max:1000',
            'startDate'           => 'required',
            'endDate'             => 'required',
            'description'         => 'max:256',
            ]);

        $start_date               = $request->input('startDate');
        $end_date                 = $request->input('endDate');

        $start_date = new carbon($start_date);
        $end_date   = new carbon($end_date);

        $examination_id    = $request->input('examination_id');

        $examination       = Examination::where('id', $examination_id)->first();
        $appointment       = Appointment::where('id', $examination->appointment_id)->first();

        $patient_id        = $appointment->on_patient;
        $from_user         = $request->user()->id;
        $inventory_id                = $request->input('inventory_id');

        $drug_id           = Inventory::where('id', $inventory_id)->value('drug_id');

        $quantity_consumed = $request->input('quantity_consumed');
        $times_a_day       = $request->input('times_a_day');
        $no_of_days        = $request->input('no_of_days');
        $description       = $request->input('description');

        $drug_name         = Inventory::where('id', $inventory_id)->value('drug_name');
        $formulation       = Inventory::where('id', $inventory_id)->value('formulation');
        $prescription      = $drug_name . " (". $formulation.")";

        //Calculations from Inventory
        $quantity_consumed = (int) $request->input('quantity_consumed');
        $times_a_day       = (int) $request->input('times_a_day');
        $no_of_days        = (int) $request->input('no_of_days');

        $consumed_drugs    = $quantity_consumed * $times_a_day * $no_of_days;
        $inventory         = DB::table('inventories')->where('id', $inventory_id)->value('quantity');
        $per_cost          = Inventory::where('id',$inventory_id)->value('per_cost');

        $quantity_left     = Inventory::where('id',$inventory_id)->value('per_cost');

        $quantity_left     = $inventory - $consumed_drugs;
        $cost              = $per_cost * $consumed_drugs;

        if($end_date<$start_date)
        {
            return redirect()->route('medical-profile')->withErrors(['Sorry, the end date for the medication cannot come before the start date.']);
        }
        else
        {
            if($quantity_left<1)
            {
                return redirect()->route('medical-profile')->withErrors(['Sorry, there isn\'t enough '. $drug_name .' '. $formulation . ' to be dispensed. You were trying to dispense '. $consumed_drugs. ' ' . $formulation .', but there are only '. $inventory.' '. $formulation. ' in stock.']); 
            }elseif($per_cost<1) {
                return redirect()->route('medical-profile')->withErrors(['Sorry, The drug ' . $drug_name . ' '. $formulation.' does not have a cost associated with it. Kindly have accounts fill in the cost then come back and make the drug medication.']); 
            }elseif(($quantity_consumed)<0||($times_a_day)<1||($no_of_days)<1) {
                return redirect()->route('medical-profile')->withErrors(['Sorry, either the quantity to be consumed in a day or how many times a day or the no. of days the drug is to be consumed, cannot be less than 0. Kindly administer the drug again.']); 
            }else{

                $medication = Medication::create([
                    'appointment_id'    => $appointment->id,
                    'drug_id'           => $inventory_id,
                    'on_patient'        => $patient_id,
                    'description'       => $description,
                    'quantity_consumed' => $quantity_consumed,
                    'times_a_day'       => $times_a_day,
                    'no_of_days'        => $no_of_days,
                    'from_date'         => $start_date, 
                    'to_date'           => $end_date,
                    'from_user'         => $from_user,
                    ]);

                $dispensation = Dispensation::create([
                    'appointment_id'     => $appointment->id,
                    'drug_id'            => $inventory_id,
                    'on_patient'         => $patient_id,
                    'medication_id'      => $medication->id,
                    'quantity_left'      => $quantity_left,
                    'quantity_consumed'  => $consumed_drugs,
                    'status'             => 0,
                    'paid'               => 0,
                    'from_user'          => $from_user
                    ]);

                $payment = Payment::create([
                    'on_patient'          => $patient_id,
                    'appointment_id'      => $appointment->id,
                    'drug_id'             => $inventory_id,
                    'status'              => 0,
                    'cost'                => $appointment->service->cost,
                    'service_id'          => $appointment->service_id,
                    'insurance_id'        => 0,
                    'provider_id'         => $appointment->service->provider_id,
                    'from_user'           => $from_user,
                    ]);

                Appointment::where('id', $appointment->id)->update(['status' => 9]);

                $flash   = 'success';
                $message = 'The medication has been prescribed successfully. Kindly, direct the patient to the accounts for payments.';

                $service_id     = $appointment->service_id;
                $service        = Service::where('id', $service_id)->first();
                $provider_id    = $service->provider_id;

                $insurance_plan = InsurancePlan::where('provider_id', $provider_id)->where('on_patient', $patient_id)->first();

                if($insurance_plan)
                {   
                    $insurance_id = $insurance_plan->id;

                    $payment->update(['status' => 1]);
                    $payment->update(['insurance_id' => $insurance_id]);
                    $dispensation->update(['paid'=> 1]);

                    Insurance::create([
                        'payment_id'           => $payment->id,
                        'on_patient'           => $patient_id,
                        'appointment_id'       => $payment->appointment_id,
                        'insurance_id'         => $insurance_plan->id,
                        'service_id'           => $payment->service_id,
                        'cost'                 => $payment->cost,
                        'status'               => 1,
                        'from_user'            => $from_user,
                        ]);

                    Appointment::where('id', $appointment->id)->update(['status' => 6]);
                    
                    $message = 'The medication has been prescribed successfully. Kindly, direct the patient to the pharmacy for medication pickup.';
                } 

                Inventory::where('id', $inventory_id)->update(['quantity' => $quantity_left]);

                return redirect()->route('medical-profile')->with($flash, $message);
            }
        }
    }
}
