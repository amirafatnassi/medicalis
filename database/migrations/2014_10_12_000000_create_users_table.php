<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom', 120);
            $table->string('prenom', 120);
            $table->unsignedBigInteger('sexe_id')->nullable();
            $table->foreign('sexe_id')->references('id')->on('sexes')->onDelete('cascade')->onUpdate('cascade');
            $table->date('datenaissance');
            $table->string('lieunaissance', 120)->nullable();
            $table->string('tel', 120)->nullable();
            $table->unsignedBigInteger('profession_id')->nullable();
            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('cascade')->onUpdate('cascade');
            $table->string('country_id')->nullable();
            $table->foreign('country_id')->references('code')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('ville_id')->nullable();
            $table->foreign('ville_id')->references('id_ville')->on('villes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('specialite_id')->nullable();
            $table->foreign('specialite_id')->references('id')->on('specialites')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('cp')->nullable();
            $table->string('rue', 120)->nullable();
            $table->mediumText('image')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->rememberToken()->nullable();
            $table->string('verification_token')->nullable();
            $table->timestamp('user_approuved_at')->nullable();
            $table->unsignedBigInteger('user_approuved_by')->nullable();
            $table->foreign('user_approuved_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
