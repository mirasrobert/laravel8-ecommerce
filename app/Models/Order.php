<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Facades\Cart as MyCart;

class Order extends Model
{
    use HasFactory;

    protected $fillable =  [
        'transaction_no',
        'product_id',
        'name',
        'image',
        'amount',
        'qty',
        'isPaid',
        'deliveredAt',
        'tax'
    ];

    public function saveOrder($data)
    {

        try {
            foreach ($data['content'] as $key => $value) {

                auth()->user()->orders()->create([
                    'product_id' => $value->id,
                    'name' => $value->name,
                    'image' => $value->options->img,
                    'amount' => $value->price,
                    'qty' => $value->qty,
                    'transaction_no' => $data['id'],
                    'isPaid' => $data['isPaid'],
                    'tax' => $data['tax']
                ]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            die('SOMETHING WENT WRONG '.$e->getMessage());
        }
            
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
