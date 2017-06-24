<?php

namespace App\Http\Controllers\Pharmacy;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Inventory;
use App\Dispensation;
use App\Http\Requests;
use DB;
use Session;
use App\Activity;
use App\Settings;

class InventoryController extends Controller
{
    public function getInventory()
    {
    	$inventories = Inventory::paginate(10);
    	$dispensations = Dispensation::where('status', 0)->orWhere('status', 1)->paginate(10);
        $dispensationsActive = Dispensation::where('status', 0)->orWhere('status', 1)->get();
        $dispensationsCount  = count($dispensationsActive);
        $settings = Settings::first();
        return view('templates.pharmacy.inventory', compact('inventories', 'dispensations', 'dispensationsCount', 'settings'));
    }

    public function searchInventory(Request $request)
    {
        $query = $request->input('search');

        $inventories = Inventory::where('formulation', 'LIKE', '%' . $query . '%')
        ->where('drug_id', 'LIKE', '%' . $query . '%')
        ->where('drug_name', 'LIKE', '%' . $query . '%')
        ->where('formulation', 'LIKE', '%' . $query . '%')
        ->where('description', 'LIKE', '%' . $query . '%')
        ->where('quantity', 'LIKE', '%' . $query . '%')
        ->where('per_cost', 'LIKE', '%' . $query . '%')
        ->where('expiry_date', 'LIKE', '%' . $query . '%')
        ->orWhereHas('users', function ($term) use($query) {
            $term->orwhere('from_user','LIKE', '%' . $query . '%');
        })->paginate(10);


        Session::flash('success', 'Search results for "'. $query . '".' );
        
        $dispensationsActive = Dispensation::where('status', 0)->orWhere('status', 1)->get();
        $dispensationsCount  = count($dispensationsActive);

        return view('templates.pharmacy.inventory', compact('inventories', 'dispensationsCount'));
    }

    public function refillNew(Request $request)
    {
        $this->validate($request, [
            'drug_name'          => 'required',
            'formulation'        => 'required',
            'quantity'           => 'required'
            ]);

        $drug_name                   = $request->input('drug_name');
        $formulation                 = $request->input('formulation');
        $description                 = $request->input('description');
        $quantity                    = $request->input('quantity');
        $from_user                   = $request->user()->id;
        

        $drug_id = Inventory::all();
        if (count($drug_id)!=0) {
            $drug_id = DB::table('inventories')->get();
            $drug_id = count($drug_id);
            $drug_id = (int)$drug_id;
            $drug_id = $drug_id + 1;

            $drug_id = "D-" . $drug_id;

            Inventory::create([
                'drug_id'            => $drug_id,
                'drug_name'          => $drug_name,
                'formulation'        => $formulation,
                'description'        => $description,
                'quantity'           => $quantity,
                'from_user'          => $from_user
                ]);

            ////////// Activity Log/////////////
            $from_user   = $request->user()->id;
            $description = " added a new drug " . $drug_name . " of formulation (" .$formulation . ") with quantity " .$quantity;
            Activity::create(['from_user'=> $from_user,'description'=> $description]);
            ///////////////////////////////////

        } else {
            $drug_id = 1;
            $drug_id = (int)$drug_id;

            $drug_id = "D-" . $drug_id;

            Inventory::create([
                'drug_id'            => $drug_id,
                'drug_name'          => $drug_name,
                'formulation'        => $formulation,
                'description'        => $description,
                'quantity'           => $quantity,
                'from_user'          => $from_user
                ]);

            ////////// Activity Log/////////////
            $from_user   = $request->user()->id;
            $description = " added a new drug " . $drug_name . " of formulation (" .$formulation . ") with quantity " .$quantity;
            Activity::create(['from_user'=> $from_user,'description'=> $description]);
            ///////////////////////////////////
        }

        $dispensations = Dispensation::paginate(10);

        return redirect()->route('pharmacy-inventory')->with('success', 'The new drug has been added successfully.');
    }

    public function refillDrug(Request $request, $id)
    {   
        $this->validate($request, [
            'quantity_added'  => 'required|numeric'
            ]);

        $quantity_added = $request->input('quantity_added');

        $drug = Inventory::where('id', $id)->first();
        $in_stock = $drug->quantity;

        $new_stock = $in_stock + $quantity_added;

        $inventory = Inventory::where('id', $id)->update(['quantity'=> $new_stock]);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " refilled the drug " . $drug->drug_name . " of formulation (" .$drug->formulation . ") with quantity " .$quantity_added . " to have in stock ". $new_stock;
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        return redirect()->route('pharmacy-inventory')->with('success', "The drug has been refilled successfully.");
    }
}
