<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ShippingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // IF USER HAS ALREADY HAVE SHIPPING ADDRESS
        if(auth()->user()->shipping()->exists())
        {
            return redirect()->route('checkout.index');
        }
        else
        {
            $provinces = DB::table('refprovince')->get();

            return view('shipping.shipping', compact('provinces'));
        }
    }

    public function populateCity(Request $request)
    {
        $value = $request->value; // Id
        $cities = DB::table('refcitymun')
                    ->select('refcitymun.*')  
                    ->where('provCode', $value)
                    ->get();

        
        $result = '<option selected="Choose" value="" disabled>Choose...</option>';

        foreach ($cities as $key => $city) {
            $result .= '<option value="'.$city->citymunCode.'">'.$city->citymunDesc.'</option>';
        }

        echo $result;
        
    }

    public function populateBrgy(Request $request)
    {
        $value = $request->value;
        $barangays = DB::table('refbrgy')
                    ->select('refbrgy.*')  
                    ->where('citymunCode', $value)
                    ->get();

        $output = '<option selected="Choose" value="" disabled>Choose...</option>';

        foreach ($barangays as $key => $brgy) {
            $output .= '<option value="'.$brgy->brgyCode.'">'.$brgy->brgyDesc.'</option>';
        }

        echo $output;
    }

    public function store(ShippingRequest $request)
    {
        auth()->user()->shipping()->create([
            'address' => $request->address,
            'contact' => $request->contact,
            'city' => $request->city,
            'province' => $request->province,
            'barangay' => $request->barangay,
        ]);

        return redirect()->route('checkout.index');
    }
                                                                                    
    public function edit() {
        if(is_null(auth()->user()->shipping)) return abort(404);


        $selectedProvince = DB::table('refprovince')
                    ->where('provCode', auth()->user()->shipping->province)
                    ->first();

        $selectedCity = DB::table('refcitymun')
                    ->where('citymunCode', auth()->user()->shipping->city)
                    ->first();

        $selectedBrgy = DB::table('refbrgy')
                    ->where('brgyCode', auth()->user()->shipping->barangay)
                    ->first();
        
        $provinces = DB::table('refprovince')->get();
        
        $cities = DB::table('refcitymun')
                    ->select('refcitymun.*')  
                    ->where('provCode', auth()->user()->shipping->province)
                    ->get();

        $barangays = DB::table('refbrgy')
                    ->select('refbrgy.*')  
                    ->where('citymunCode', auth()->user()->shipping->city)
                    ->get();
        return view('shipping.edit-shipping', compact('provinces', 'cities', 'barangays', 'selectedProvince', 'selectedCity', 'selectedBrgy'));

    }

    public function update(ShippingRequest $request)
    {
        
        $user = new User();
        if($user->realUser(auth()->user()->shipping->user_id))
        {
            auth()->user()->shipping()->update($request->only([
                'address',
                'contact',
                'city',
                'province',
                'barangay'
            ]));

            return redirect()->route('orders.index');
        } else {
            return back();
        }

        

        
    }
    
}
