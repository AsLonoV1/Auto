<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'category_id',
        'product_amout',
        'product_count',
        'product_title'
    ];
    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }

}
