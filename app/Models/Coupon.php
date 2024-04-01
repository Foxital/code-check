<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'coupons';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = ['name', 'offer_val', 'offer_type', 'validity_from', 'validity_to', 'status'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $visible = ['id', 'name', 'offer_val', 'offer_type', 'validity_from', 'validity_to', 'status','created_at','updated_at'];

}
