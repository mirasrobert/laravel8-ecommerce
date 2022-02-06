<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'qty',
        'description',
        'brand',
        'category',
        'image',
        'slug'
    ];


    public function getPriceAttribute()
    {

        return number_format(($this->attributes['price']), 2, '.', ',');
    }

    // A product can have a many users/customers into the cart
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Update Product Qty
    public function updateProductQuantity($data)
    {
        try {
            foreach ($data['content'] as $key => $value) {

                $product = Product::findOrFail($value->id);

                $product->update([
                    'qty' => ($product->qty) - ($value->qty)
                ]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            die('SOMETHING WENT WRONG ' . $e->getMessage());
        }
    }

    public function photos()
    {
        return $this->morphMany(Photos::class, 'imageable');
    }
}
