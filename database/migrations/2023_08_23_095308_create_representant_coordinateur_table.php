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
        Schema::create('representant_coordinateur', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('representant_id');
            $table->foreign('representant_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('coordinateur_id');
            $table->foreign('coordinateur_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('actif')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representant_coordinateur');
    }
};
