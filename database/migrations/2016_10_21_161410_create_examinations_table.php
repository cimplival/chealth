<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinations', function(Blueprint $table)
        {
            $table->increments('id');
            
            $table->integer('appointment_id');

            $table->integer('on_patient');

            $table->integer('service_id');

            $table->integer('status');

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
        Schema::drop('examinations');
    }
}
