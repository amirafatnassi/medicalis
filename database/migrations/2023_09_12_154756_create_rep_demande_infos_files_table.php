<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepDemandeInfosFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rep_demande_infos_files', function (Blueprint $table) {
            $table->id();
            $table->String('downloads');
            $table->unsignedBigInteger('idRepDemandeInfos')->nullable();
            $table->foreign('idRepDemandeInfos')->references('id')->on('rep_demande_infos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('rep_demande_infos_files');
    }
}
