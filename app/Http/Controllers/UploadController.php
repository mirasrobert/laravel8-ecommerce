<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $data = $request->except('_token');

        // Loop in each incoming request
        foreach ($data as $key => $value) {

            if ($request->hasFile($key)) {


                $img = $request->file($key)->getRealPath();

                // Upload an image file to cloudinary with one line of code
                $uploadedFileUrl = cloudinary()->upload($img, [
                    "folder" => "img",
                    "transformation" => [
                        "width" => 640,
                        "height" => 640,
                        "crop" => "fit"
                    ]
                ])->getSecurePath();

                return $uploadedFileUrl;
            }
        }
    }
}
