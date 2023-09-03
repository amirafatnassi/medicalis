<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->string('id');
            $table->unsignedBigInteger('groupe_sanguin')->nullable();
            $table->foreign('groupe_sanguin')->references('id')->on('bloodtypes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('taille')->nullable();
            $table->string('poids')->nullable();
            $table->binary('antecedants_med')->nullable();
            $table->binary('antecedants_chirg')->nullable();
            $table->binary('antecedants_fam')->nullable();
            $table->binary('allergies')->nullable();
            $table->binary('indicateur_bio')->nullable();
            $table->binary('traitement_chr')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('convention_id')->references('id')->on('conventions')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('convention_id')->nullable();
            $table->string('contactdurgence')->nullable();
            $table->string('nss')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dossiers');
    }
}
