<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('blogs', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->string('name');
            $table->string('link_code');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_descp')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->tinyInteger('featured')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('category_id')
            //     ->references('id')
            //     ->on('blog_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
