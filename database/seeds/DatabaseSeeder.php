<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
       
        $this->call('RoleSeeder');
        $this->call('ReportsSeeder');
        $this->call('UserSeeder');
        $this->call('ServiceSeeder');
        $this->call('SettingsSeeder');
        $this->call('NotificationsSeeder');
        $this->call('ProvidersSeeder');
        $this->call('ProvidersSeeder');

        Model::reguard();
    }
}
