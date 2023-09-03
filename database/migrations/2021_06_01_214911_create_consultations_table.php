<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->unsignedBigInteger('motif_id')->nullable();
            $table->foreign('motif_id')->references('id')->on('motifs')->onDelete('cascade')->onUpdate('cascade');
            $table->string('taille')->nullable();
            $table->string('poids')->nullable();
            $table->string('ta')->nullable();
            $table->string('pouls')->nullable();
            $table->binary('observation');
            $table->string('observation_prive')->nullable();
            $table->string('effet_marquant')->nullable();
            $table->binary('effet_marquant_txt')->nullable();
            $table->unsignedBigInteger('medecin_id')->nullable();
            $table->foreign('medecin_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('dossier_id');
            $table->foreign('dossier_id')->references('id')->on('dossiers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('consultations');
    }
}
