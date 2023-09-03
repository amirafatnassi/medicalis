<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplyfilesMedPatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replyfiles_med_pats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('downloads');
            $table->unsignedBigInteger('id_reply_med_patients');
            $table->foreign('id_reply_med_patients')->references('id')->on('reply_med_patients')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('replyfiles_med_pats');
    }
}
