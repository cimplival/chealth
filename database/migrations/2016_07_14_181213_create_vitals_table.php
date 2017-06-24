<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitals', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('appointment_id');

            $table->integer('on_patient');

            $table->double('weight');

            $table->double('height');

            $table->double('bmi');

            $table->double('blood_pressure');

            $table->double('pulse');
            
            $table->double('temperature');

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
        Schema::drop('vitals');
    }
}
