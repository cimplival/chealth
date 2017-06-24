<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('beds', function(Blueprint $table)
      {
          $table->increments('id');

          $table->integer('ward_no')->unsigned();

          $table->string('bed_no') -> unique();
          
          $table->text('bed_notes');

          $table->integer('bed_status')->unsigned()->default(0);

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
        Schema::drop('beds');
    }
}
