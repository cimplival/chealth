<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnknownPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unknown_patients', function (Blueprint $table) {
            
            $table->increments('id');

            $table->integer('patient_id');

            $table->integer('appointment_id');

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
        Schema::drop('unknown_patients');
    }
}
