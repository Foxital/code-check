<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class userAddress extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'users_address';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = ['user_id', 'fname', 'lname', 'address', 'optional_name', 'city', 'country', 'state', 'pin_code', 'mobile_num', 'created_at', 'updated_at'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    public function User(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}

