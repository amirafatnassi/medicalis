<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplyMedPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reply_med_patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('emetteur_id');
            $table->string('destination_id');
            $table->unsignedBigInteger('discussion_id');
            $table->foreign('discussion_id')->references('id')->on('discussions_med_patients')->onDelete('cascade')->onUpdate('cascade');
            $table->text('content');
            $table->integer('status');
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
        Schema::dropIfExists('reply_med_patients');
    }
}
