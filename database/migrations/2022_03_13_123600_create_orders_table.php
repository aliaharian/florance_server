<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('cabin_size')->nullable();
            $table->string('mirror_size')->nullable();
            $table->string('has_mirror')->default(0);
            $table->unsignedBigInteger('color_id')->nullable()->index();
            $table->unsignedBigInteger('cabin_material_id')->nullable()->index();
            $table->unsignedBigInteger('surface_material_id')->nullable()->index();
            $table->unsignedBigInteger('bowl_material_id')->nullable()->index();
            $table->unsignedBigInteger('mirror_material_id')->nullable()->index();
            $table->unsignedBigInteger('drawer_material_id')->nullable()->index();
            $table->unsignedBigInteger('attachment_id')->nullable()->index();
            $table->text('description')->nullable();
            $table->string('total_price')->nullable();
            $table->enum('state',['ordered','pricing','pay1','building','shipping','failed','pending','done','pay2','canceled','waitForPay1','waitForPay2'])->default('ordered');
            $table->text('admin_comment')->nullable();
            $table->string('tracking_code')->nullable();
            $table->timestamp('arrival_date')->nullable();
            $table->string('post_price')->nullable();
            $table->unsignedBigInteger('address_id')->nullable()->index();
            $table->json('meta')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('cabin_material_id')->references('id')->on('materials');
            $table->foreign('surface_material_id')->references('id')->on('materials');
            $table->foreign('bowl_material_id')->references('id')->on('materials');
            $table->foreign('mirror_material_id')->references('id')->on('materials');
            $table->foreign('drawer_material_id')->references('id')->on('materials');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('attachment_id')->references('id')->on('attachments');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
