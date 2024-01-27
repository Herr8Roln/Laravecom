<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description','price','discount_price','available_qte','category_id' ,'picture'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
