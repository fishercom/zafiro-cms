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
            $table->bigInteger('member_id')->unsigned();
            $table->decimal('total', 8, 2);
            $table->char('money', 4)->nullable();
            $table->string('token_payment', 255)->nullable();
            $table->string('session_id')->nullable();
            $table->string('verification')->nullable();
            $table->text('metadata')->nullable();
            $table->string('comments', 1024);
            $table->enum('status', ['PENDING', 'PAID', 'REFUSED']);
            $table->timestamps();

            $table->foreign('member_id')
                  ->references('id')
                  ->on('members');
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
