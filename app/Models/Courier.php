<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courier extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'couriers';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = ['name', 'price', 'status'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $visible = ['id', 'name','price','status','created_at','updated_at'];

}
