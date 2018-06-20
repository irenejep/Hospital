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
            $table->integer('patientId')->unsigned;
            $table->string('patientFullName', 30);
            $table->string('patientNationalId', 30);
            $table->date('patientDob');
            $table->tinyInteger('patientGender', 1);
        });
        function tinyInteger($column, $autoIncrement = false, $unsigned = false)
        {
            return $this->addColumn('tinyInteger', $column, compact('autoIncrement', 'unsigned'));
        }
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
