<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userSubscribe extends Model
{
    use HasFactory;

    protected $table = 'user_subscribes';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = [ 'email' ];

}
