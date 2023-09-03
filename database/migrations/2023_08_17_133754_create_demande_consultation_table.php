<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demande_consultation', function (Blueprint $table) {
            $table->id();
            $table->string('dossier_id');
            $table->foreign('dossier_id')->references('id')->on('dossiers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status_demande')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('type_demande_id');
            $table->foreign('type_demande_id')->references('id')->on('type_demande')->onDelete('cascade')->onUpdate('cascade');
            $table->string('objet');
            $table->unsignedBigInteger('coordinateur_en_charge')->nullable();
            $table->foreign('coordinateur_en_charge')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->binary('observation')->nullable();
            $table->unsignedBigInteger('closed_by')->nullable();
            $table->foreign('closed_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('closed_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_consultation');
    }
};
