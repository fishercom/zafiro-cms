<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('member_id')->unsigned();
            $table->bigInteger('sender_id')->unsigned();
            $table->string('subject');
            $table->text('message')->nullable();
            $table->text('metadata')->nullable();
            $table->boolean('read')->nullable();
            $table->boolean('trash')->nullable();
            $table->timestamps();

            $table->foreign('member_id')
                  ->references('id')
                  ->on('members');

            $table->foreign('sender_id')
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
        Schema::dropIfExists('messages');
    }
}
