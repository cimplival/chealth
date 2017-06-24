<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInpatientsTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inpatients', function (Blueprint $table) {
            
            $table->increments('id');

            $table->integer('patient_id');

            $table->integer('appointment_id');

            $table->integer('status');

            $table->integer('ward_id');

            $table->integer('bed_id');

            $table->integer('from_user');            
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inpatients');
    }
}
