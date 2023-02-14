<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sold extends Model
{
    use HasFactory;

    protected $table = 'sold_products';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'product_amout',
        'product_count',
        'product_name'
    ];
}
