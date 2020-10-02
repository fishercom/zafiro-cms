<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsArticlesLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_articles_log', function (Blueprint $table) {
            $table->id();
            $table->integer('article_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            //$table->text('comments')->nullable();
            $table->timestamps();

            $table->foreign('article_id')
                  ->references('id')
                  ->on('cms_articles')
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
        Schema::dropIfExists('cms_articles_log');
    }
}
