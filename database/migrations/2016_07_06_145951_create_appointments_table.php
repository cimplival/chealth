<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            
            $table->increments('id');

            $table->integer('on_patient')->unsigned()->default(0);

            $table->integer('service_id')->unsigned()->default(0);

            $table->integer('staff_id')->unsigned()->default(0);

            $table->integer('status');
            
            $table->dateTime('scheduled_at');

            $table->integer('from_user')->unsigned()->default(0);
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
        Schema::drop('appointments');
    }
}
