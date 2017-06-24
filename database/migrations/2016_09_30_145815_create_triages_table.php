<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('triage_vitals', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('appointment_id');

            $table->integer('on_patient') -> unsigned() -> default(0);

            $table->integer('service_id') -> unsigned() -> default(0);

            $table->integer('status');

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
        Schema::drop('triage_vitals');
    }
}
