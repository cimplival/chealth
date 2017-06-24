<?php

namespace App\Http\Controllers\Pharmacy;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Dispensation;
use App\Inventory;
use App\Medication;
use App\Payment;
use App\Http\Requests;
use Auth;
use Session;
use DB;
use Carbon\Carbon;

class ArchivesController extends Controller
{
    
    public function getArchives()
    {   
        //Dispensation status = 0 means Not Dispensed, status = 1 means Pending, status = 2 means Dispensed 
        //Dispensation paid = 0 means Not Paid, paid = 1 means Paid

        $dispensations = Dispensation::where('status', 2)->paginate(10);
        $dispensationsActive = Dispensation::where('status', 0)->orWhere('status', 1)->get();
        $dispensationsCount  = count($dispensationsActive);
        $drugs               = DB::table('inventories')->get();
        return view('templates.pharmacy.archives', compact('dispensations', 'dispensationsCount', 'drugs'));
    }

    public function dispenseDrug($id, Request $request)
    {
        $updatedBy = Auth::user()->fullname;

        Dispensation::where('id', $id)->update(['status'=> 2]);

        Session::flash('info', 'The drug has been successfully dispensed.');

        return redirect()->route('pharmacy-dispensations'); 
    }


    //Dispensation status = 0 means Not Dispensed, status = 1 means Pending, status = 2 means Dispensed 
    //Dispensation paid = 0 means Not Paid, paid = 1 means Paid

    public function prepareDrug($id, Request $request)
    {
        $updatedBy = Auth::user()->fullname;
        Dispensation::where('id', $id)->update(['status'=> 1]);
        $drugId                   = $request->input('drugId');
        $quantity_dispensed       = $request->input('quantityDispensed');

        //Convert the dates
        $startDate                = $request->input('startDate');
        $endDate                  = $request->input('endDate');

        $startDate = new carbon($startDate);
        $endDate   = new carbon($endDate);

        $quantity_dispensed = (int)$quantity_dispensed;
        $quantity_inventory = Inventory::where('drugId',$drugId)->value('quantity');
        $medical_id         = Dispensation::where('id',$id)->value('medId');
        $per_cost           = Inventory::where('drugId',$drugId)->value('per_cost');

        //$per_cost           = floatval($per_cost);

        $total_sum          = $per_cost * $quantity_dispensed;

        $quantity_inventory = (int)$quantity_inventory;

        $quantity_remaining = $quantity_inventory - $quantity_dispensed;

        $this->validate($request, [
                'quantityDispensed'    => 'required|max:20',
                'startDate'            => 'required|max:20',
                'endDate'              => 'required|max:20',
        ]);
        
        Inventory::where('drugId',$drugId)->update(['quantity'=> $quantity_remaining]);

        Dispensation::where('id', $id)->update(['quantity_dispensed'=> $quantity_dispensed]);
        Dispensation::where('id', $id)->update(['from_date'=> $startDate]);
        Dispensation::where('id', $id)->update(['to_date'=> $endDate]);
        Dispensation::where('id',$id)->update(['quantity_left'=> $quantity_remaining]);
        Dispensation::where('id', $id)->update(['total_cost'=> $total_sum]);

        Medication::where('drugId', $drugId)->first()->update(['from_date'=> $startDate]);
        Medication::where('drugId', $drugId)->first()->update(['to_date'=> $endDate]);

        Payment::where('medId', $medical_id)->where('drugId',$drugId)->where('cost', 0)->update(['cost'=> $total_sum]);

        Session::flash('info', 'You have successfully checked out the drug cost.');

        return redirect()->route('pharmacy-dispensations'); 
    }

    public function searchArchives(Request $request)
    {
        $query = $request->input('search');

        $dispensations = DB::table('dispensations')
                                        ->where('id', 'LIKE', '%' . $query . '%')
                                        ->orWhere('medId', 'LIKE', '%' . $query . '%')
                                        ->orWhere('drugId', 'LIKE', '%' . $query . '%')
                                        ->orWhere('onPatient', 'LIKE', '%' . $query . '%')
                                        ->orWhere('from_user', 'LIKE', '%' . $query . '%')
                                        ->orWhere('prescription', 'LIKE', '%' . $query . '%')
                                        ->orWhere('description', 'LIKE', '%' . $query . '%')
                                        ->orWhere('from_date', 'LIKE', '%' . $query . '%')
                                        ->orWhere('to_date', 'LIKE', '%' . $query . '%')
                                        ->orWhere('quantity_dispensed', 'LIKE', '%' . $query . '%')
                                        ->orWhere('quantity_left', 'LIKE', '%' . $query . '%')
                                        ->where('status', 2)
                                        ->where('paid', 1)
                                        ->paginate(10);


        Session::flash('info-dispensations', 'There were ' . count($dispensations) .' search results for "'. $query . '".' );
        
        $dispensationsActive = Dispensation::where('status', 0)->orWhere('status', 1)->get();
        $dispensationsCount  = count($dispensationsActive);

        return view('templates.pharmacy.archives', compact('dispensations', 'dispensationsCount'));
    }

}
