<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'blog_category';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = ['name', 'image', 'link_code', 'lineup', 'status'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $visible = ['id', 'name','image','link_code','status','lineup','created_at','updated_at'];

}

