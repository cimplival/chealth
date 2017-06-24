<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('appointment_id');

            $table->integer('drug_id');

            $table->integer('on_patient');
                  
            $table->integer('quantity_consumed');
            
            $table->integer('times_a_day');

            $table->integer('no_of_days');

            $table->text('description')->nullable();

            $table->dateTime('from_date')->nullable();

            $table->dateTime('to_date')->nullable();

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
        Schema::drop('medications');
    }
}
