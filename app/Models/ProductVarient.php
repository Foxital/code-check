<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVarient extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'product_varient';

    protected $primaryKey = 'id';

    protected $timestamp = true;

    protected $fillable = ['product_id', 'label', 'price', 'discount', 'quantity', 'status'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $visible = ['id', 'product_id', 'label', 'price', 'discount', 'quantity', 'status'];

    public function Product(){
        return $this->belongsTo(Product::class);
    }

}
