<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurancePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_plans', function (Blueprint $table) {
            
            $table->increments('id');

            $table->string('on_patient');

            $table->string('national_id');

            $table->string('insurance_identifier');

            $table->integer('provider_id');

            $table->integer('confirmed')->default(0);

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
        Schema::drop('insurance_plans');
    }
}
