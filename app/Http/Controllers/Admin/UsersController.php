<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Hash;
use DB;

class UsersController extends Controller
{
    public function getUsers()
    {
    	$users = User::paginate(10);
    	$roles = Role::orderBy('name', 'asc')->get();

    	return view('templates.admin.users', compact('users', 'roles'));	
    }

    public function createNewUser(Request $request)
    {
    	$this->validate($request, [
                'full_name'              => 'required|min:4|max:256',
                'username'              => 'required|min:4|max:256',
                'staff_id'              => 'required|min:4|max:256',
                'password'              => 'required|min:8|max:256',
                'role_name'                  => 'required',
        ]);

        $fullname   = $request->input('full_name');
        $username   = $request->input('username');
        $staff_id   = $request->input('staff_id');
        $password   = Hash::make($request->input('password'));
        $role_name  = strtolower($request->input('role_name'));

        $adminRole            = Role::whereName('administrator')->first();
        $receptionistRole     = Role::whereName('receptionist')->first();
        $triageRole           = Role::whereName('triage')->first();
        $doctorRole           = Role::whereName('doctor')->first();
        $accountantRole       = Role::whereName('accountant')->first();
        $pharmacyRole         = Role::whereName('pharmacy')->first();
        $nurseRole            = Role::whereName('nurse')->first();
        $laboratoristRole     = Role::whereName('laboratorist')->first();

        if($role_name=="administrator")
        {
        	$user = User::create(array(
	            'fullname'      => $fullname,
	            'username'      => $username,
	            'staffId'       => $staff_id,
	            'password'      => $password
	        ));
	        $user->assignRole($adminRole);
        }
        if($role_name=="receptionist")
        {
        	$user = User::create(array(
	            'fullname'      => $fullname,
	            'username'      => $username,
	            'staffId'       => $staff_id,
	            'password'      => $password
	        ));
	        $user->assignRole($receptionistRole);
        }
        if($role_name=="triage")
        {
        	$user = User::create(array(
	            'fullname'      => $fullname,
	            'username'      => $username,
	            'staffId'       => $staff_id,
	            'password'      => $password
	        ));
	        $user->assignRole($triageRole);
        }
        if($role_name=="doctor")
        {
        	$user = User::create(array(
	            'fullname'      => $fullname,
	            'username'      => $username,
	            'staffId'       => $staff_id,
	            'password'      => $password
	        ));
	        $user->assignRole($doctorRole);
        }
        if($role_name=='accountant')
        {
        	$user = User::create(array(
	            'fullname'      => $fullname,
	            'username'      => $username,
	            'staffId'       => $staff_id,
	            'password'      => $password
	        ));
	        $user->assignRole($accountantRole);
        }
        if($role_name=="pharmacy")
        {
        	$user = User::create(array(
	            'fullname'      => $fullname,
	            'username'      => $username,
	            'staffId'       => $staff_id,
	            'password'      => $password
	        ));
	        $user->assignRole($pharmacyRole);
        }
        if($role_name=="nurse")
        {
        	$user = User::create(array(
	            'fullname'      => $fullname,
	            'username'      => $username,
	            'staffId'       => $staff_id,
	            'password'      => $password
	        ));
	        $user->assignRole($nurseRole);
        }
      	if($role_name=="laboratorist")
        {
        	$user = User::create(array(
	            'fullname'      => $fullname,
	            'username'      => $username,
	            'staffId'       => $staff_id,
	            'password'      => $password
	        ));
	        $user->assignRole($laboratoristRole);
        }

        return redirect()->route('admin-users')->with('info', 'A new user has been created successfully.');
    }

    public function editUser(Request $request, $id)
    {
    	$this->validate($request, [
                'full_name'              => 'required|min:4|max:256',
                'username'              => 'required|min:4|max:256',
                'staffId'               => 'required|min:4|max:256',
                'password'              => 'required|min:8|max:256',
        ]);
        
        $user_id = $request->input('user_id');

        $user  = User::where('id', $user_id)->first();
        $input = $request->all();
        $user->fill($input)->save();

        return redirect()->route('admin-users')->with('info', 'The user has been updated successfully.');
    }

    public function deleteUser($id)
    {   
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin-users')->with('info', 'The user has been deleted successfully.');
    }

     public function searchUser(Request $request){
     	$roles = Role::orderBy('name', 'asc')->get();
        $query = $request->input('search');
        $users = DB::table('users')->where('fullname', 'LIKE', '%' . $query . '%')
                                        ->orWhere('username', 'LIKE', '%' . $query . '%')
                                        ->orWhere('staffId', 'LIKE', '%' . $query . '%')
                                        ->paginate(10);

 
        //return redirect()->route('admin-users', compact('users', 'roles')) 
        return view('templates.admin.users', compact('users', 'roles'))->with('info', 'There were ' . count($users) .' search results for "'. $query . '".' );
    }

    public function addRole(Request $request)
    {
        $user_id   = $request->input('user_id');
        $role_name = $request->input('role_name');
        $user = User::whereId($user_id)->first();

        $adminRole            = Role::whereName('administrator')->first();
        $receptionistRole     = Role::whereName('receptionist')->first();
        $triageRole           = Role::whereName('triage')->first();
        $doctorRole           = Role::whereName('doctor')->first();
        $accountantRole       = Role::whereName('accountant')->first();
        $pharmacyRole         = Role::whereName('pharmacy')->first();
        $nurseRole            = Role::whereName('nurse')->first();
        $laboratoristRole     = Role::whereName('laboratorist')->first();

        if($role_name=="administrator")
        {
            $user->assignRole($adminRole);
        }
        if($role_name=="receptionist")
        {
            $user->assignRole($receptionistRole);
        }
        if($role_name=="triage")
        {
            $user->assignRole($triageRole);
        }
        if($role_name=="doctor")
        {
            $user->assignRole($doctorRole);
        }
        if($role_name=='accountant')
        {
            $user->assignRole($accountantRole);
        }
        if($role_name=="pharmacy")
        {
            $user->assignRole($pharmacyRole);
        }
        if($role_name=="nurse")
        {
            $user->assignRole($nurseRole);
        }
        if($role_name=="laboratorist")
        {
            $user->assignRole($laboratoristRole);
        }

        return redirect()->route('admin-users')->with('info', 'The role '. $role_name . ' has been added successfully to the user.');
    }

    public function removeRole(Request $request)
    {
        $user_id   = $request->input('user_id');
        $role_name = $request->input('role_name');
        $user = User::whereId($user_id)->first();

        $adminRole            = Role::whereName('administrator')->first();
        $receptionistRole     = Role::whereName('receptionist')->first();
        $triageRole           = Role::whereName('triage')->first();
        $doctorRole           = Role::whereName('doctor')->first();
        $accountantRole       = Role::whereName('accountant')->first();
        $pharmacyRole         = Role::whereName('pharmacy')->first();
        $nurseRole            = Role::whereName('nurse')->first();
        $laboratoristRole     = Role::whereName('laboratorist')->first();

        if($role_name=="administrator")
        {
            $user->removeRole($adminRole);
        }
        if($role_name=="receptionist")
        {
            $user->removeRole($receptionistRole);
        }
        if($role_name=="triage")
        {
            $user->removeRole($triageRole);
        }
        if($role_name=="doctor")
        {
            $user->removeRole($doctorRole);
        }
        if($role_name=='accountant')
        {
            $user->removeRole($accountantRole);
        }
        if($role_name=="pharmacy")
        {
            $user->removeRole($pharmacyRole);
        }
        if($role_name=="nurse")
        {
            $user->removeRole($nurseRole);
        }
        if($role_name=="laboratorist")
        {
            $user->removeRole($laboratoristRole);
        }

        return redirect()->route('admin-users')->with('info', 'You have removed successfully the role '. $role_name . ' from the user.');
    }

    public function changePassword()
    {
        return view('templates.main.change-password');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password'     => 'required',
            'new_password'     => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
        $data = $request->all();
     
        $user = User::find(auth()->user()->id);
        if(!Hash::check($data['old_password'], $user->password)){
             return back()
                        ->withErrors('The specified password does not match the database password');
        }else{
            User::where('id', $user->id)->update(['password' => Hash::make($data['new_password']) ]);
            return redirect()->route('change-password')->with('success', 'You have successfully changed the password.');
        }

    }
}
