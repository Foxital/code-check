<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = ['name', 'category_id', 'sub_category_id', 'link_code', 'image', 'image1', 'image2', 'image4', 'description', 'how_to_use', 'meta_title', 'meta_descp', 'meta_keyword', 'status'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    public function ProductVarient(){
        return $this->hasMany(ProductVarient::class);
    }

    public function ProdCatg(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function ProdSubCatg(){
        return $this->hasOne(SubCategory::class);
    }

}
