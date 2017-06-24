<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('on_patient');

            $table->integer('appointment_id');
            
            $table->integer('drug_id')->unsigned() -> default(0);

            $table->string('diagnosis');

            $table->dateTime('from_date');

            $table->dateTime('to_date');

            $table->text('notes');

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
        Schema::drop('diagnosis');
    }
}
