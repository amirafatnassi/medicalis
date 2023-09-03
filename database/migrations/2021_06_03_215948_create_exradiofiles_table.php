<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExradiofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exradiofiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('downloads');
            $table->unsignedBigInteger('idexradio');
            $table->foreign('idexradio')->references('id')->on('examenradios')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('exradiofiles');
    }
}
