<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeDevisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_devis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status_demande')->onDelete('cascade')->onUpdate('cascade');
            $table->string('objet');
            $table->unsignedBigInteger('type_demande_id')->nullable();
            $table->foreign('type_demande_id')->references('id')->on('type_demande')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->binary('observation')->nullable();
            $table->unsignedBigInteger('demande_cons_id');
            $table->foreign('demande_cons_id')->references('id')->on('demande_consultation')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('demande_devis');
    }
}