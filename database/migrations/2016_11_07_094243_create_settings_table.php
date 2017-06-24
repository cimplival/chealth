<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            
            $table->increments('id');

            $table->string('name_of_institution');

            $table->string('tagline');

            $table->string('email_address');

            $table->string('phone_no');

            $table->string('currency');

            $table->string('postal_address');

            $table->string('location');

            $table->string('website');

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
        Schema::drop('settings');
    }
}
