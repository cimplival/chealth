<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Settings;
use App\Activity;

class SettingsController extends Controller
{
    public function getSettings()
    {
    	$settings = Settings::first();

    	return view('templates.admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request, $id)
    {
    	$this->validate($request, [
            'name_of_institution'  => 'required',
            'tagline'              => 'required',
            'email_address'        => 'required',
            'phone_no'             => 'required',
            'currency'             => 'currency',
            'postal_address'       => 'required',
            'location'             => 'required',
            'website'              => 'required'
        ]);

        $from_user = $request->user()->id;

        $settings = Settings::where('id', $id)->first();
        $input = $request->all();
        $settings->fill($input)->save();

        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " updated the main settings.";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        return redirect()->route('admin-settings')->with('success', 'The Main Settings have been updated successfully.');
    }
}
