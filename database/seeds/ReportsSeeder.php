<?php

use Illuminate\Database\Seeder;
use App\Report;

class ReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reports')->delete();

        Report::create([
            'name'          => 'accountant',
            'description'   => 'Send daily accounts report to Accountant email.',
            'status'        =>  0,
            'from_user'     =>  8
        ]);

        Report::create([
            'name'          => 'pharmacy',
            'description'   => 'Send daily pharmacy report to Pharmacy email.',
            'status'        =>  0,
            'from_user'     =>  8
        ]);

        Report::create([
            'name'          => 'reception',
            'description'   => 'Send daily reception report to Human Resources email.',
            'status'        =>  0,
            'from_user'     =>  8
        ]);

        Report::create([
            'name'          => 'triage',
            'description'   => 'Send daily triage report to Human Resources email.',
            'status'        =>  0,
            'from_user'     =>  8
        ]);

        Report::create([
            'name'          => 'examination',
            'description'   => 'Send daily examination report to Human Resources email.',
            'status'        =>  0,
            'from_user'     =>  8
        ]);

        Report::create([
            'name'          => 'laboratory',
            'description'   => 'Send daily laboratory report to Human Resources email.',
            'status'        =>  0,
            'from_user'     =>  8
        ]);

        Report::create([
            'name'          => 'inpatient',
            'description'   => 'Send daily inpatient report to Human Resources email.',
            'status'        =>  0,
            'from_user'     =>  8
        ]);

        Report::create([
            'name'          => 'administrator',
            'description'   => 'Send daily admin report to Administrator email.',
            'status'        =>  0,
            'from_user'     =>  8
        ]);
    }
}
