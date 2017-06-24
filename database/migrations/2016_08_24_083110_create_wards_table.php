<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('wards', function(Blueprint $table)
      {
          $table->increments('id');

          $table->string('ward_name')->unique();

          $table->text('ward_notes');

          $table->integer('ward_capacity');

          $table->integer('ward_status') -> unsigned() -> default(0);

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
        //
    }
}
