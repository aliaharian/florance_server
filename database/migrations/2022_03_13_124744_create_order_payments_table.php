<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->index();
            $table->string('price');
            $table->boolean('payed')->default(0);
            $table->unsignedBigInteger('transaction_id')->nullable()->index();
            $table->timestamp('payed_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->json('meta')->nullable();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('transaction_id')->references('id')->on('transactions');

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
        Schema::dropIfExists('order_payments');
    }
}
