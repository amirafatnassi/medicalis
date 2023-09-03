<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeDevisFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_devis_files', function (Blueprint $table) {
            $table->id();
            $table->String('downloads');
            $table->unsignedBigInteger('idDemandeDevis')->nullable();
            $table->foreign('idDemandeDevis')->references('id')->on('demande_devis')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('demande_devis_files');
    }
}
