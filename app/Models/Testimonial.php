<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'testimonials';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = ['type','name', 'image', 'description', 'designation', 'status'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $visible = ['id', 'type','name', 'image', 'description', 'designation', 'status','created_at','updated_at'];

}

