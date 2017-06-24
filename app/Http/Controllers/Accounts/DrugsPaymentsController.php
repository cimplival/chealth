<?php

namespace App\Http\Controllers\Accounts;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Inventory;
use App\Settings;

class DrugsPaymentsController extends Controller
{
    public function getPayments()
    {
    	$payments  = DB::table('payments')->where('status', 0)->get();
    	$inventories = DB::table('inventories')->paginate(10);
    	$settings = Settings::first();
        return view('templates.accounts.drugs-payments', compact('payments', 'inventories', 'settings'));
    }

    public function updateCost(Request $request, $id)
    {
    	$this->validate($request, [
                'drug_id'           => 'required',
                'per_cost'              => 'required|numeric'
        ]);

        $updatedBy = $request->user()->id;
        $cost      = $request->input('per_cost');

        $inventory = Inventory::where('id', $id)->first()->update(['per_cost' => $cost]);
        
        return redirect()->route('drugs-payments')->with('success', 'The price of the drug has been added successfully.');
    }
}
