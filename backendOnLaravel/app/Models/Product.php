<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug','image', 'description', 'user_id', 'category_id','raiting','count', 'price'];


    public function category() { //?: SHOW CATEGORY
        return $this->belongsTo(Category::class);
    }
    public function user() { //?: SHOW USER
        return $this->belongsTo(User::class);
    }
    public function comments() { //?: SHOW COMMENTS
        return $this->hasMany(Comment::class);
    }
    public function oreders() { //?: SHOW ORDERS
        return $this->hasMany(Order::class);
    }
}
