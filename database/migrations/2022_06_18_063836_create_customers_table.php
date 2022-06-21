<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->unique();
            $table->string('f_username')->comment('customer first name');
            $table->string('s_username')->comment('customer last name');
            $table->string('primary_phone')->comment('customer primary phone number');
            $table->string('secondary_phone')->comment('customer secondary phone number');
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->unsignedBigInteger('refered_agent_id');
            $table->foreign('refered_agent_id')->references('id')->on('agents');
            $table->unsignedBigInteger('scheme_id');
            $table->foreign('scheme_id')->references('id')->on('schemes');
            $table->boolean('complement_one')->default(0);
            $table->boolean('complement_two')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('customers');
    }
}
