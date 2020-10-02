<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->string('phone')->nullable();
            $table->enum('document_type', ['DNI','RUC','CE','PASSPORT'])->nullable();
            $table->string('document', 15)->nullable();
            $table->string('department_id', 2)->nullable();
            $table->string('province_id', 4)->nullable();
            $table->string('district_id', 6)->nullable();
            $table->string('zip_code', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('reference')->nullable();
            $table->enum('member_type', ['COMPANY', 'CLIENT'])->nullable();
            $table->boolean('acceptance')->nullable();
            $table->text('metadata')->nullable();
            $table->enum('status', ['PENDING', 'ACTIVE', 'BLOCKED', 'TRASH']);
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');

            $table->foreign('department_id')
                  ->references('id')
                  ->on('ubg_departments');

            $table->foreign('province_id')
                  ->references('id')
                  ->on('ubg_provinces');

            $table->foreign('district_id')
                  ->references('id')
                  ->on('ubg_districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
