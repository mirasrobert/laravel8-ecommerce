<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'comment',
        'rate'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function products()
    {
        $this->belongsTo(Product::class);
    }
}
