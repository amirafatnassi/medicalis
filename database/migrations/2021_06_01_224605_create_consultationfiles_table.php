<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultationfiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('downloads');
            $table->unsignedBigInteger('idConsultation')->nullable();
            $table->foreign('idConsultation')->references('id')->on('consultations')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('consultationfiles');
    }
}
