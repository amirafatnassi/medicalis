<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenradiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examenradios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('url_radio')->nullable();
            $table->unsignedBigInteger('type_radio');
            $table->foreign('type_radio')->references('id')->on('radiotypes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('radio');
            $table->foreign('radio')->references('id')->on('radios')->onDelete('cascade')->onUpdate('cascade');
            $table->string('radio2')->nullable();
            $table->unsignedBigInteger('id_medecin')->nullable();
            $table->foreign('id_medecin')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->binary('lettre')->nullable();
            $table->string('remarques')->nullable();
            $table->String('dossier');
            $table->foreign('dossier')->references('id')->on('dossiers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('examenradios');
    }
}
