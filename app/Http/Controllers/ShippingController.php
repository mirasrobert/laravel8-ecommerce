<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingRequest;
use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->shipping()->exists())
        {
            return redirect()->route('checkout.index');
        }

        return view('checkout.shipping');
    }

    public function store(ShippingRequest $request)
    {
        auth()->user()->shipping()->create([
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'contact' => $request->contact,
            'city' => $request->city,
            'province' => $request->province,
            'country' => $request->country
        ]);

        return redirect()->route('checkout.index');
    }
    
}
