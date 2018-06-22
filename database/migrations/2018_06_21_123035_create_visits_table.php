<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('visit_id');
            $table->dateTime('visit_date');
            $table->foreign('patient_id')->references('patient_id')->on('patients');
            $table->integer('patient_id')->unsigned();
            $table->tinyInteger('visit_type');
            $table->dateTime('visit_exit_time');
            $table->tinyInteger('visit_status');
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
        Schema::dropIfExists('visits');
    }
}
