<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart_items';
    protected $fillable = ['quantity','pc_product_id','pc_size','user_id', 'product_category_id'];
    use HasFactory;

    public function inventory(){
        return $this->belongsTo(Inventory::class, 'product_inventory_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
