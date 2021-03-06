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
            $table->id();
            $table->integer('profile_id')->unsigned()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username')->nullable();
            $table->string('password');
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('is_member')->nullable();
            $table->text('userdata')->nullable(); //photos, documents, fields
            $table->boolean('active')->nullable();
            $table->boolean('default')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('profile_id')
                  ->references('id')
                  ->on('profiles'); //->onDelete('cascade');

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
