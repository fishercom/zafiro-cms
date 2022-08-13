<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->unsigned();
            $table->integer('subcategory_id')->unsigned()->nullable();
            $table->integer('brand_id')->unsigned();
            $table->string('name');
            $table->string('resumen', 512);
            $table->text('description');
            $table->decimal('price', 8, 2)->nullable();
            $table->json('metadata')->nullable(); //photos, colors, video, url
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('id')
                  ->on('cms_parameters');

            $table->foreign('subcategory_id')
                  ->references('id')
                  ->on('cms_parameters');

            $table->foreign('brand_id')
                  ->references('id')
                  ->on('cms_parameters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
