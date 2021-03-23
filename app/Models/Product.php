<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // A product can have a many users/customers into the cart
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
