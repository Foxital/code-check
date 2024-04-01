<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'orders';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = ['user_id', 'razorpay_order_id', 'razorpay_payment_id', 'total_amount', 'sub_total_amount', 'delivery_fees', 'paid', 'product_order_list', 'ship_address', 'coupon', 'coupon_price', 'wallet_taken', 'paid_to_wallet', 'pay_res', 'return_status', 'return_txt', 'notepay', 'status'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
