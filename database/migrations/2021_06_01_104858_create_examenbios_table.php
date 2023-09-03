<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenbiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examenbios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->unsignedBigInteger('id_medecin')->nullable();
            $table->foreign('id_medecin')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->binary('lettre')->nullable();
            $table->string('url_bio')->nullable();
            $table->string('dossier')->nullable();
            $table->foreign('dossier')->references('id')->on('dossiers')->onDelete('cascade')->onUpdate('cascade');
           $table->string('remarques')->nullable();
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
        Schema::dropIfExists('examenbios');
    }
}
