<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'faqs';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = ['link_code', 'question', 'answer', 'lineup', 'status'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $visible = ['id', 'link_code', 'question', 'answer', 'lineup', 'status','created_at','updated_at'];

}
