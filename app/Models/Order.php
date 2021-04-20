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
        'amount',
        'qty'
    ];

    public function saveOrder($data)
    {
            foreach ($data['content'] as $key => $value) {

                auth()->user()->orders()->create([
                    'product_id' => $value->id,
                    'amount' => $value->price,
                    'qty' => $value->qty,
                    'transaction_no' => $data['id']
                ]);
    
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
