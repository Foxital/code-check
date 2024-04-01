<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'settings';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = ['page', 'val', 'status'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $visible = ['id', 'page','val','status','created_at','updated_at'];

}

