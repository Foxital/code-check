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

            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('sub_category_id');

            $table->string('link_code');

            $table->string('image')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->Text('description')->nullable();
            $table->Text('how_to_use')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_descp')->nullable();
            $table->string('meta_keyword')->nullable();

            $table->tinyInteger('featured')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('category_id')
            //     ->references('id')
            //     ->on('category');
            //
            // $table->foreign('sub_category_id')
            //     ->references('id')
            //     ->on('sub_category');
        });


        Schema::create('product_varient', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->char('label',20);
            $table->decimal('price', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->Integer('quantity');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('product_id')
            //     ->references('id')
            //     ->on('products');
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
        Schema::dropIfExists('product_varient');
    }
}
