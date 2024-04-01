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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile',25)->unique()->nullable();
            $table->tinyInteger('signup_type')->default(1);
            $table->date('anniversary_date')->nullable();
            $table->string('provider_id',150)->nullable();
            $table->date('dob_date')->nullable();
            $table->decimal('wallet', 10, 2)->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users_address', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->char('fname',100);
            $table->char('lname',100)->nullable();
            $table->string('address','255');
            $table->string('optional_name','255')->nullable();
            $table->char('city',50);
            $table->char('country',30);
            $table->char('state',30);
            $table->char('pin_code',10);
            $table->char('mobile_num',10);
            $table->tinyInteger('primary_addrs')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->char('razorpay_order_id',100);
            $table->char('razorpay_payment_id',100)->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->decimal('sub_total_amount', 10, 2);
            $table->decimal('delivery_fees', 10, 2);
            $table->tinyInteger('paid')->default(0);

            $table->Text('product_order_list');
            $table->Text('ship_address');

            $table->char('coupon',50)->nullable();
            $table->decimal('coupon_price', 10, 2)->default(0);

            $table->decimal('wallet_taken', 10, 2)->default(0);
            $table->decimal('paid_to_wallet', 10, 2)->default(0);

            $table->Text('pay_res')->nullable();

            $table->tinyInteger('return_status')->default(0);
            $table->Text('return_txt')->nullable();
            $table->Text('notepay')->nullable();

            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('user_addresses');
        Schema::dropIfExists('orders');
    }
}
