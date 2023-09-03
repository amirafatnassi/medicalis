<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeInfosFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_infos_files', function (Blueprint $table) {
            $table->id();
            $table->String('downloads');
            $table->unsignedBigInteger('idDemandeInfos')->nullable();
            $table->foreign('idDemandeInfos')->references('id')->on('demande_infos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('demande_infos_files');
    }
}
