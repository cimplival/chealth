<?php

use Illuminate\Database\Seeder;
use App\Notification;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifications')->delete();

        Notification::create([
            'notification_name'   => 'Send an SMS to the patient after the patient has been registered. ',
            'status'              =>  0,
            'from_user'           =>  1
        ]);

        Notification::create([
            'notification_name'   => 'Send an SMS to the patient after the patient has been examined and been discharged.',
            'status'              =>  0,
            'from_user'           =>  1
        ]);

        Notification::create([
            'notification_name'   => 'Send an SMS to the patient after an appointment has been scheduled.',
            'status'              =>  0,
            'from_user'           =>  1
        ]);

        Notification::create([
            'notification_name'   => 'Send an Email to the patient after the patient has been registered. ',
            'status'              =>  0,
            'from_user'           =>  1
        ]);

        Notification::create([
            'notification_name'   => 'Send an Email to the patient after the patient has been examined and been discharged.',
            'status'              =>  0,
            'from_user'           =>  1
        ]);

        Notification::create([
            'notification_name'   => 'Send an Email to the patient after an appointment has been scheduled.',
            'status'              =>  0,
            'from_user'           =>  1
        ]);

    }
}
