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
        'product_id',
        'order_no',
        'amount'
    ];

    public function saveOrder($data)
    {
            foreach ($data['content'] as $key => $value) {

                auth()->user()->orders()->create([
                    'product_id' => $value->id,
                    'order_no' => $data['order_no'],
                    'amount' => $value->price
                ]);
    
            }
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
