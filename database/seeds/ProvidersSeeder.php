<?php

use Illuminate\Database\Seeder;
use App\Provider;

class ProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('providers')->delete();

        Provider::create([
            'name'            =>  'Self-Sponsored',
            'from_user'       =>  8
        ]);

        Provider::create([
            'name'            =>  'NHIF',
            'from_user'       =>  8
        ]);

        Provider::create([
            'name'            =>  'Jubilee Insurance',
            'from_user'       =>  8
        ]);

        Provider::create([
            'name'            =>  'UAP Insurance',
            'from_user'       =>  8
        ]);

        Provider::create([
            'name'            =>  'MPESA',
            'from_user'       =>  8
        ]);

        Provider::create([
            'name'            =>  'Airtel Money',
            'from_user'       =>  8
        ]);

        Provider::create([
            'name'            =>  'Orange Money',
            'from_user'       =>  8
        ]);

        Provider::create([
            'name'            =>  'VISA',
            'from_user'       =>  8
        ]);

        Provider::create([
            'name'            =>  'MasterCard',
            'from_user'       =>  8
        ]);

        Provider::create([
            'name'            =>  'Paypal',
            'from_user'       =>  8
        ]);


    }
}
