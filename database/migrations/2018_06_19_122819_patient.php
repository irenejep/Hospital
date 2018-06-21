<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Patient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('patient_id');
            $table->string('patient_fullname');
            $table->string('patient_national_id');
            $table->date('patient_dob');
            $table->tinyInteger('patient_gender');
            $table->timestamps();
        });
        // function tinyInteger($column, $autoIncrement = false, $unsigned = false)
        // {
        //     return $this->addColumn('tinyInteger', $column, compact('autoIncrement', 'unsigned'));
        // }
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
