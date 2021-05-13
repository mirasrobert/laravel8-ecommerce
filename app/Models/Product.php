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

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    // Update Product Qty
    public function updateProductQuantity($data)
    {
        try {
            foreach ($data['content'] as $key => $value) {
    
                $product = Product::findOrFail($value->id);

                // $product->qty = (($product->qty) - ($value->qty));
                // $product->save(); 
    
                $product->update([
                    'qty' => ($product->qty) - ($value->qty)
                ]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            die('SOMETHING WENT WRONG '.$e->getMessage());
        }
    }
}
