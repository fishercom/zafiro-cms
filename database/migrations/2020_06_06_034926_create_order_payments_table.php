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
            $table->bigInteger('order_id')->unsigned();
            $table->integer('purchaseOperationNumber');
            $table->integer('purchaseAmount');
            $table->char('purchaseCurrencyCode', 4);
            $table->string('descriptionProducts')->nullable();
            $table->string('authorizationResult');
            $table->string('authorizationCode');
            $table->string('errorCode')->nullable();
            $table->string('errorMessage')->nullable();
            $table->string('httpSessionId')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->foreign('order_id')
                  ->references('id')
                  ->on('orders')
                  ->onDelete('cascade');
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
