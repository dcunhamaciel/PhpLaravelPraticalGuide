<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ImageUploadRequest;

class ImageUploadController extends Controller
{
    public function upload(ImageUploadRequest $request)
    {
        $file = $request->file('image');
        $name = Str::random(10);

        $url = Storage::putFileAs('images', $file, $name . '.' . $file->extension());

        return ['url' => env('APP_URL') . '/' . $url];
    }
}
