<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('trainings_id');
            $table->unsignedBigInteger('classes_id');
            $table->unsignedBigInteger('students_id');
            $table->foreign('trainings_id')->references('id')->on('trainings');
            $table->foreign('classes_id')->references('id')->on('classes');
            $table->foreign('students_id')->references('id')->on('students');
            $table->string('type');
            $table->integer('score');
            $table->integer('over_all');
            $table->string('remarks');
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
        Schema::dropIfExists('records');
    }
}
