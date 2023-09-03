<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDossierUserSpecialite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossier_user_specialite', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('dossier_user_id');
            $table->unsignedBigInteger('specialite_id');
            $table->foreign('dossier_user_id')->references('id')->on('dossier_medecins')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('specialite_id')->references('id')->on('specialites')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('dossier_user_specialite');
    }
}
