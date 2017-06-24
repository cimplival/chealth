<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Activity;

class NotificationsController extends Controller
{
    public function getNotifications()
    {
    	$notifications= Notification::get();

    	return view('templates.admin.notifications', compact('notifications'));
    }

    public function updateNotifications(Request $request, $id)
    {

        $from_user = $request->user()->id;

        $notification = $request->input('status');

        //If input checked, null is returned else 0 is returned
        if($notification===null)
        {
            Notification::where('id', $id)->update(['status' => 0]);
        }
        else{
            Notification::where('id', $id)->update(['status' => 1]);
        }
        
        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " updated a notification.";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////

        return redirect()->route('admin-notifications')->with('success', 'The notification has been updated successfully.');
    }

}
