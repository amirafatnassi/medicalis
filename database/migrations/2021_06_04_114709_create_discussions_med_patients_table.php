<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionsMedPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussions_med_patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('emetteur_id')->nullable();
            $table->foreign('emetteur_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('destination_id')->nullable(); 
            $table->foreign('destination_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('dossier_id')->nullable();
            $table->foreign('dossier_id')->references('id')->on('dossiers')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->string('type_courrier');
            $table->integer('etat')->nullable();
            $table->integer('rep')->nullable();
            $table->integer('cloture');
            $table->string('M_P')->nullable();
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
        Schema::dropIfExists('discussions_med_patients');
    }
}
