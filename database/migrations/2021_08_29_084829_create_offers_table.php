<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->char('name',100);
            $table->decimal('offer_val',10,2);
            $table->tinyInteger('offer_type')->default(1);
            $table->date('validity_from');
            $table->date('validity_to');
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
        Schema::dropIfExists('offers');
    }
}
