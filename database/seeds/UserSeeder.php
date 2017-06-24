<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Report;
use App\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $adminRole            = Role::whereName('administrator')->first();
        $receptionistRole     = Role::whereName('receptionist')->first();
        $triageRole           = Role::whereName('triage')->first();
        $doctorRole           = Role::whereName('doctor')->first();
        $accountantRole       = Role::whereName('accountant')->first();
        $pharmacyRole         = Role::whereName('pharmacy')->first();
        $nurseRole            = Role::whereName('nurse')->first();
        $laboratoristRole     = Role::whereName('laboratorist')->first();

        $accountantReport     = Report::whereName('accountant')->first();
        $pharmacyReport       = Report::whereName('pharmacy')->first();
        $receptionReport      = Report::whereName('reception')->first();
        $triageReport         = Report::whereName('triage')->first();
        $examinationReport    = Report::whereName('examination')->first();
        $laboratoryReport     = Report::whereName('laboratory')->first();
        $inpatientReport      = Report::whereName('inpatient')->first();
        $administratorReport  = Report::whereName('administrator')->first();


        $user = User::create(array(
            'full_name'      => 'John Doe',
            'user_name'      => 'admin',
            'staff_id'       => '999999',
            'email'          => 'mwangi_valentino@yahoo.com',
            'password'       => Hash::make('password')
        ));
        $user->assignRole($adminRole);
        $user->assignRole($receptionistRole);
        $user->assignRole($triageRole);
        $user->assignRole($doctorRole);
        $user->assignRole($accountantRole);
        $user->assignRole($pharmacyRole);
        $user->assignRole($nurseRole);
        $user->assignRole($laboratoristRole);

        $user->assignReport($administratorReport);

        $user = User::create(array(
            'full_name'      => 'Jane Jouy',
            'user_name'      => 'reception',
            'staff_id'       => '123456',
            'email'          => 'mwangi_valentino@yahoo.com',
            'password'       => Hash::make('password')
        ));
        $user->assignRole($receptionistRole);

        $user->assignReport($receptionReport);
        $user->assignReport($triageReport);
        $user->assignReport($examinationReport);
        $user->assignReport($laboratoryReport);
        $user->assignReport($inpatientReport);

        $user = User::create(array(
            'full_name'      => 'Titus Home',
            'user_name'      => 'triage',
            'staff_id'       => '123486',
            'email'          => 'mwangi_valentino@yahoo.com',
            'password'       => Hash::make('password')
        ));
        $user->assignRole($triageRole);


        $user = User::create(array(
            'full_name'      => 'Rene Vosdme',
            'user_name'      => 'doctor',
            'staff_id'       => '123422',
            'email'          => 'mwangi_valentino@yahoo.com',
            'password'       => Hash::make('password')
        ));
        $user->assignRole($doctorRole);
        $user->assignRole($receptionistRole);
        $user->assignReport($inpatientReport);
        $user->assignReport($examinationReport);

        $user = User::create(array(
            'full_name'      => 'Christine Mueni',
            'user_name'      => 'accounts',
            'staff_id'       => '333456',
            'email'          => 'mwangi_valentino@yahoo.com',
            'password'       => Hash::make('password')
        ));
        $user->assignRole($accountantRole);

        $user = User::create(array(
            'full_name'      => 'Rose Ludy',
            'user_name'      => 'pharmacy',
            'staff_id'       => '223456',
            'email'          => 'mwangi_valentino@yahoo.com',
            'password'       => Hash::make('password')
        ));
        $user->assignRole($pharmacyRole);

        $user = User::create(array(
            'full_name'      => 'Qeue Lose',
            'user_name'      => 'nurse',
            'staff_id'       => '1233456',
            'email'          => 'mwangi_valentino@yahoo.com',
            'password'       => Hash::make('password')
        ));
        $user->assignRole($nurseRole);

        $user = User::create(array(
            'full_name'      => 'Valentine Mwangi',
            'user_name'      => 'laboratory',
            'staff_id'       => '1234256',
            'email'          => 'mwangi_valentino@yahoo.com',
            'password'       => Hash::make('password')
        ));
        $user->assignRole($laboratoristRole);
    }
}
