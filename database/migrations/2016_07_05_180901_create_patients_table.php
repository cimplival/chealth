<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            
            $table->increments('id');

            $table->string('med_id')->unique();

            $table->string('first_name')->nullable();

            $table->string('middle_name')->nullable();

            $table->string('last_name')->nullable();

            $table->date('date_birth')->nullable();

            $table->integer('estimated_age')->nullable();

            $table->string('gender')->nullable();

            $table->string('patient_phone')->nullable();

            $table->string('kin_name')->nullable();

            $table->string('kin_relationship')->nullable();

            $table->string('kin_phone')->nullable();

            $table->string('email')->nullable();

            $table->string('residence')->nullable();

            $table->string('county')->nullable();

            $table->string('country_origin')->nullable();

            $table->integer('from_user') -> unsigned() -> default(0);
            $table->foreign('from_user')
                  ->references('id')->on('users');
                  
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
        Schema::drop('patients');
    }
}
