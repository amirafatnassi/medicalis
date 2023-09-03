<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tva')->default(0);
            $table->bigInteger('total_ht')->default(0);
            $table->bigInteger('total_ttc')->default(0);
            $table->char('currency', 4);
            $table->unsignedBigInteger('demande_devis_id');
            $table->foreign('demande_devis_id')->references('id')->on('demande_devis')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status_invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('receiver_id');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('sender_id');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->text('payment_info')->nullable();
            $table->text('note')->nullable();
            $table->date('date');
            $table->date('due_date');
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
        Schema::dropIfExists('invoices');
    }
}
