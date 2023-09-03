<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDossierMedecinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossier_medecins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('medecin_id');
            $table->foreign('medecin_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('dossier_id');
            $table->foreign('dossier_id')->references('id')->on('dossiers')->onDelete('cascade')->onUpdate('cascade');
            $table->string('controle')->nullable();
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
        Schema::dropIfExists('dossier_medecins');
    }
}
