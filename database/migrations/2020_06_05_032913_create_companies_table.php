<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('member_id')->unsigned();
            $table->string('ruc', 11);
            $table->string('name');
            $table->string('phone_1', 30)->nullable();
            $table->string('phone_2', 30)->nullable();
            $table->string('website')->nullable();
            $table->text('metadata')->nullable(); //photos, documents, fields
            $table->text('contact')->nullable(); //photos, documents, fields
            $table->text('billingdata')->nullable(); //photos, documents, fields
            $table->boolean('verified')->nullable();
            $table->string('status_id', 1)->nullable();
            $table->timestamps();

            $table->foreign('member_id')
                  ->references('id')
                  ->on('members'); //->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
