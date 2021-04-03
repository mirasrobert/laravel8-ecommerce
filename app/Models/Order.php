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
        'order_no'
    ];

    public function saveOrder($content, $order_no)
    {
            foreach ($content as $key => $value) {

                auth()->user()->orders()->create([
                    'product_id' => $value->id,
                    'order_no' => $order_no
                ]);
    
            }
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
