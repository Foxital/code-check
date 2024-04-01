<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_category';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = ['name', 'image', 'link_code', 'lineup', 'status', 'category_id'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    public function Catgs(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
