<?php

namespace App\Http\Controllers\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;
use App\Http\Requests;
use Session;
use Auth;
use DB;
use App\User;
use App\Activity;
use App\Settings;

class ServicesController extends Controller
{
    //GET EXPENSES
    public function getServices(Request $request)
    {
        $payments  = DB::table('payments')->where('status', 0)->get();

        $services = Service::paginate(10);

        $settings = Settings::first();

        $user = Auth::user()->id;

        return view('templates.accounts.services', compact('services', 'user', 'users', 'payments', 'settings'));    
    }

    public function addService(Request $request)
    {
    	$this->validate($request, [
            'service_name'        => 'required|max:265',
            'cost'                => 'required|numeric',
            'status'          => 'required'
            ]);

        Service::create([
            'service_name'    => $request->input('service_name'),
            'cost'            => $request->input('cost'),
            'status'          => $request->input('status'),
            'from_user'       => $request->user()->id,
            ]);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " added service of name ". $request->input('service_name') . " of cost ". $request->input('cost'). ".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        return redirect()->route('accounts-services')->with('success', 'The service has been added successfully.'); 
    }

    public function deleteService(Request $request, $id)
    {   
        $service = Service::find($id);

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " deleted service of name ". $service->service_name . " of cost ". $service->cost. ".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        $service->delete();

        return redirect()->route('accounts-services')->with('success', 'The service has been deleted successfully.');
    }

    public function updateService($id, Request $request)
    {
    	$this->validate($request, [
            'service_name'        => 'required|max:265',
            'cost'                => 'required|numeric',
            'status'              => 'required',
            ]);

        $updatedBy = Auth::user()->fullname;

        $service = Service::where('id', $id)->first();
        $input = $request->all();

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " updated service of name ". $service->service_name ." to \"". $request->input('service_name') ."\" and of cost ". $service->cost . " to \"". $request->input('cost'). "\".";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        $service->fill($input)->save();

        

        return redirect()->route('accounts-services')->with('success', 'The service has been updated successfully.'); 
    }

    public function searchService(Request $request){

        $query = $request->input('search');
        $services = Service::where('id', 'LIKE', '%' . $query . '%')
        ->orWhere('service_name', 'LIKE', '%' . $query . '%')
        ->orWhere('cost', 'LIKE', '%' . $query . '%')
        ->orWhere('created_at', 'LIKE', '%' . $query . '%')
        ->WhereHas('provider', function ($term) use($query) {
            $term->where('name','LIKE', '%' . $query . '%');
        })->orWhereHas('users', function ($term) use($query) {
            $term->where('full_name','LIKE', '%' . $query . '%');
            $term->orwhere('user_name','LIKE', '%' . $query . '%');
        })->paginate(10);

        $user = $request->user()->id;
        
        return view('templates.accounts.services', compact('services', 'user'))->with('success', 'There were ' . count($services) .' search results.' );
    }
}
