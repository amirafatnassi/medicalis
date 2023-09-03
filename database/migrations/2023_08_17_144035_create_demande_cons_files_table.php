<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeConsFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_cons_files', function (Blueprint $table) {
            $table->id();
            $table->String('downloads');
            $table->unsignedBigInteger('idDemandeCons')->nullable();
            $table->foreign('idDemandeCons')->references('id')->on('demande_consultation')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('demande_cons_files');
    }
}
