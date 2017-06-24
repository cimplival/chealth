<?php

namespace App\Http\Controllers\Pharmacy;
use App\Http\Controllers\Controller;
use App\Dispensation;
use App\Inventory;
use App\Refill;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;

class RefillController extends Controller
{
    public function getRefill()
    {
    	$refills = Refill::paginate(10);
    	$dispensations = Dispensation::where('status', 0)->orWhere('status', 1)->paginate(10);
        $dispensationsActive = Dispensation::where('status', 0)->orWhere('status', 1)->get();
        $dispensationsCount  = count($dispensationsActive);
        return view('templates.pharmacy.refill', compact('dispensations', 'refills','dispensationsCount'));
    }

    

    public function searchRefills(Request $request)
    {
        $query = $request->input('search');

        $refills = DB::table('refills')
                                        ->where('id', 'LIKE', '%' . $query . '%')
                                        ->orWhere('drug_id', 'LIKE', '%' . $query . '%')
                                        ->orWhere('drugName', 'LIKE', '%' . $query . '%')
                                        ->orWhere('formulation', 'LIKE', '%' . $query . '%')
                                        ->orWhere('description', 'LIKE', '%' . $query . '%')
                                        ->orWhere('quantity', 'LIKE', '%' . $query . '%')
                                        ->orWhere('expiryDate', 'LIKE', '%' . $query . '%')
                                        ->orWhere('createdBy', 'LIKE', '%' . $query . '%')
                                        ->paginate(10);

        Session::flash('info-refills', 'Search results for "'. $query . '".' );
        
        $dispensationsActive = Dispensation::where('status', 0)->orWhere('status', 1)->get();
        $dispensationsCount  = count($dispensationsActive);

        return view('templates.pharmacy.refill', compact('refills', 'dispensationsCount'));
    }

}
