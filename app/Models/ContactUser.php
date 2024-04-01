<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'contact_users';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = [ 'name','email','message' ];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];
}
