<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pages';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = ['name', 'link_code', 'description', 'image', 'meta_title', 'meta_descp', 'meta_keyword', 'status'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

}
