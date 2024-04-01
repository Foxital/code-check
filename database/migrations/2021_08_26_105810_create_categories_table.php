<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name',100);
            $table->string('image')->nullable();
            $table->string('link_code');
            $table->integer('lineup')->default(0);
            $table->tinyInteger('featured')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sub_category', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->char('name',100);
            $table->string('image')->nullable();
            $table->string('link_code');
            $table->integer('lineup')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('category_id')
            //     ->references('id')
            //     ->on('category')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
        Schema::dropIfExists('sub_category');
    }
}
