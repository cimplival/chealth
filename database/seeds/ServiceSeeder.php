<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
        DB::table('services')->delete();

        Service::create([
            'provider_id'     =>  1,
            'service_name'    => 'Consultation',
            'cost'            =>  800,
            'status'          =>  1,
            'lab_status'      =>  0,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  1,
            'service_name'    => 'Laboratory',
            'cost'            =>  2000,
            'status'          =>  1,
            'lab_status'      =>  1,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  1,
            'service_name'    => 'Emergency',
            'cost'            =>  1000,
            'status'          =>  1,
            'lab_status'      =>  1,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  1,
            'service_name'    => 'Medical Certificate',
            'cost'            =>  1000,
            'status'          =>  1,
            'lab_status'      =>  0,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  1,
            'service_name'    => 'Inpatient',
            'cost'            =>  10000,
            'status'          =>  1,
            'lab_status'      =>  0,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  2,
            'service_name'    => 'Consultation',
            'cost'            =>  1000,
            'status'          =>  1,
            'lab_status'      =>  0,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  2,
            'service_name'    => 'Laboratory',
            'cost'            =>  1500,
            'status'          =>  1,
            'lab_status'      =>  1,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  2,
            'service_name'    => 'Pharmacy',
            'cost'            =>  10000,
            'status'          =>  1,
            'lab_status'      =>  0,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  2,
            'service_name'    => 'Inpatient',
            'cost'            =>  10000,
            'status'          =>  1,
            'lab_status'      =>  0,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  3,
            'service_name'    => 'Consultation',
            'cost'            =>  500,
            'status'          =>  1,
            'lab_status'      =>  0,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  3,
            'service_name'    => 'Laboratory',
            'cost'            =>  1000,
            'status'          =>  1,
            'lab_status'      =>  1,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  4,
            'service_name'    => 'Consultation',
            'cost'            =>  1000,
            'status'          =>  1,
            'lab_status'      =>  0,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  4,
            'service_name'    => 'Laboratory',
            'cost'            =>  1500,
            'status'          =>  1,
            'lab_status'      =>  1,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  5,
            'service_name'    => 'Consultation',
            'cost'            =>  1000,
            'status'          =>  1,
            'lab_status'      =>  0,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  5,
            'service_name'    => 'Laboratory',
            'cost'            =>  1500,
            'status'          =>  1,
            'lab_status'      =>  1,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  6,
            'service_name'    => 'Consultation',
            'cost'            =>  1100,
            'status'          =>  1,
            'lab_status'      =>  0,
            'from_user'       =>  8
        ]);

        Service::create([
            'provider_id'     =>  6,
            'service_name'    => 'Laboratory',
            'cost'            =>  1300,
            'status'          =>  1,
            'lab_status'      =>  1,
            'from_user'       =>  8
        ]);

    }
}
