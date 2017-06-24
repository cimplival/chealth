<?php

use Illuminate\Database\Seeder;
use App\Settings;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('settings')->delete();

        Settings::create([
            'name_of_institution' => 'cHealth Hospital',
            'tagline'             => 'We bring simplicity to healthcare',
            'email_address'       => 'info@chealth.io',
            'phone_no'            => '+254 700299223',
            'currency'            => 'Rs',
            'postal_address'      => 'P.O. Box 12332-00200',
            'location'            => 'Along Thika Super Highway, Ruaraka, Nairobi',
            'website'             => 'http://www.chealth.io',
            'from_user'           =>  8
        ]);

    }
}
