<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['id', 'name', 'price', 'information', 'color_id', 'product_category_id'];
    use HasFactory;

    public function photo(){
        return $this->hasMany(Photo::class);
    }

    public function color(){
        return $this->belongsTo(Color::class,'color_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'product_category_id');
    }

    public function inventory(){
        return $this->hasMany(Inventory::class);
    }
}
