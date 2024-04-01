<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class userReview extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'product_review';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = ['link_code', 'name', 'email', 'rate', 'message','image', 'status','created_at','updated_at'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    public function User(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}

