<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllergiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergies', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('appointment_id');

            $table->integer('on_patient') -> unsigned() -> default(0);
            
            $table->string('allergy');

            $table->string('severity');

            $table->dateTime('observation_date');

            $table->integer('status');

            $table->string('reactions');

            $table->string('notes');

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
        Schema::drop('allergies');
    }
}
