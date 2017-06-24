<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispensationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispensations', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('appointment_id');

            $table->integer('drug_id');

            $table->integer('on_patient');

            $table->integer('medication_id');

            $table->integer('quantity_left');

            $table->float('quantity_consumed');

            $table->integer('status')->default(0);

            $table->integer('paid')->default(0);
            
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
        Schema::drop('dispensations');
    }
}
