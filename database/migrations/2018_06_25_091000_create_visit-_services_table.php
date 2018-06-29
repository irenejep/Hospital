<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit-_services', function (Blueprint $table) {
            $table->increments('visit_service_id');
            $table->integer('visit_id')->unsigned();
            $table->foreign('visit_id')->references('visit_id')->on('visits');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('service_id')->on('services');
            $table->double('visit_service_amount');
            $table->integer('quantity');
            $table->dateTime('visit_service_bill_time');
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
        Schema::dropIfExists('visit-_services');
    }
}
