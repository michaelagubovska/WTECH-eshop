<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'product_inventory';
    protected $fillable = ['id','size','quantity','product_id'];
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function cart(){
        return $this->hasMany(Cart::class,'product_inventory_id');
    }
}
