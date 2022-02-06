<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class ProfileController extends Controller
{
    public function index()
    {
        session()->forget('thankyou');

        $data = [
            'selectedProvince' => '',
            'selectedCity' => '',
            'selectedBrgy' => ''
        ];

        if (auth()->user()->shipping) {
            $data['selectedProvince'] = DB::table('refprovince')
                ->where('provCode', auth()->user()->shipping->province)
                ->first();

            $data['selectedCity'] = DB::table('refcitymun')
                ->where('citymunCode', auth()->user()->shipping->city)
                ->first();

            $data['selectedBrgy'] = DB::table('refbrgy')
                ->where('brgyCode', auth()->user()->shipping->barangay)
                ->first();
        }

        return view('user.profile.index', $data);
    }

    public function changeAvatar()
    {
        request()->validate([
            'avatar' => 'required|image'
        ]);

        $file = request()->file('avatar');
        $img = $file->getRealPath();

        $uploadedFileUrl = cloudinary()->upload($img, [
            "folder" => "img",
            "transformation" => [
                "width" => 1200,
                "height" => 1200,
                "crop" => "fit"
            ]
        ])->getSecurePath();

        auth()->user()->update([
            'avatar' => $uploadedFileUrl
        ]);

        return response()->json(['image' => $uploadedFileUrl]);

    }
}
