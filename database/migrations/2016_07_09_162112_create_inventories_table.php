<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('drug_id');
            
            $table->string('drug_name');
            
            $table->string('formulation');

            $table->string('description');

            $table->float('quantity');

            $table->double('per_cost')->nullable();

            $table->dateTime('expiry_date')->nullable();

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
        Schema::drop('inventories');
    }
}
