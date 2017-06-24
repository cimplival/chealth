<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('appointment_id');

            $table->integer('drug_id')->unsigned() -> default(0);
            
            $table->integer('on_patient')->unsigned();

            $table->integer('status');

            $table->integer('service_id')->unsigned();
            
            $table->double('cost');

            $table->integer('insurance_id')->unsigned()-> default(0);

            $table->integer('provider_id')->unsigned()-> default(0);
            
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
        Schema::drop('payments');
    }
}
