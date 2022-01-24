<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
    use HasFactory;
    protected $fillable =['id','name'];
    public function product(){
        return $this->hasMany(Product::class);
    }
}
