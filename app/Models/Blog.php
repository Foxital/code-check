<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'blogs';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = ['category_id', 'name', 'link_code', 'description', 'image', 'meta_title', 'meta_descp', 'meta_keyword', 'status'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];
    
    public function BlogCatg(){
        return $this->hasOne(BlogCategory::class);
    }

}
