<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExbiofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exbiofiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('downloads');
            $table->unsignedBigInteger('idexbio');
            $table->foreign('idexbio')->references('id')->on('examenbios')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('exbiofiles');
    }
}
