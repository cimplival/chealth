<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
        DB::table('roles')->delete();

        Role::create([
            'name' => 'receptionist'
        ]);

        Role::create([
            'name' => 'triage'
        ]);

        Role::create([
            'name' => 'doctor'
        ]);

        Role::create([
            'name' => 'accountant'
        ]);

        Role::create([
            'name' => 'pharmacy'
        ]);

        Role::create([
            'name' => 'nurse'
        ]);

        Role::create([
            'name' => 'laboratorist'
        ]);

        Role::create([
            'name' => 'administrator'
        ]);
    }
}
