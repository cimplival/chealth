<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondaryVitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secondary_vitals', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('appointment_id');

            $table->integer('on_patient');

            $table->string('cardiovascular');

            $table->string('respiratory');

            $table->string('abdomen');

            $table->integer('blood_sugar');

            $table->string('stool');

            $table->string('urine');

            $table->string('hiv_I_II');

            $table->string('haemoglobin');

            $table->text('conclusion');

            $table->string('name_designate');

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
        Schema::drop('secondary_vitals');
    }
}
