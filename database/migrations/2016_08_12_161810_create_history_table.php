<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('appointment_id');
            
            $table->integer('on_patient') -> unsigned() -> default(0);

            $table->string('history');

            $table->string('relationship');

            $table->date('from_date');

            $table->date('to_date');

            $table->string('status');

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
        Schema::drop('histories');
    }
}
