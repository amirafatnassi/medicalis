<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_detail', function (Blueprint $table) {
            $table->id();
            $table->char('description', 255)->nullable();
            $table->char('name', 255)->nullable();
            $table->bigInteger('discount')->default(0)->description('en millimes');
            $table->bigInteger('quantity')->default(1);
            $table->boolean('is_free')->default(false);
            $table->bigInteger('prix_unitaire')->default(0)->description('en millimes, inclus TVA');
            $table->bigInteger('Prix_ht')->default(0)->description('en millimes, inclus TVA');
            $table->bigInteger('Prix_ttc')->default(0)->description('en millimes, inclus TVA');
            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices');
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
        Schema::dropIfExists('invoice_detail');
    }
}
