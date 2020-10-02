<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->string('name');
            $table->string('phone_office', 30)->nullable();
            $table->string('phone_mobile', 30)->nullable();
            $table->string('department_id', 2)->nullable();
            $table->string('province_id', 4)->nullable();
            $table->string('district_id', 6)->nullable();
            $table->string('zip_code', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('latitude', 20)->nullable();
            $table->string('longitude', 20)->nullable();
            $table->text('metadata')->nullable(); //photos, documents, fields
            $table->boolean('active')->nullable();
            $table->timestamps();

            $table->foreign('company_id')
                  ->references('id')
                  ->on('companies'); //->onDelete('cascade');

            $table->foreign('department_id')
                  ->references('id')
                  ->on('ubg_departments')
                  ->onDelete('cascade');
            $table->foreign('province_id')
                  ->references('id')
                  ->on('ubg_provinces')
                  ->onDelete('cascade');
            $table->foreign('district_id')
                  ->references('id')
                  ->on('ubg_districts')
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
        Schema::dropIfExists('company_locals');
    }
}
