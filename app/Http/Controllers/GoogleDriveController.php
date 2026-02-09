<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GoogleDriveController extends Controller
{
    //
    public function index()
    {
        return view('file-upload');
    }

    public function uploadFileToDrive(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $response = Storage::disk('google')->put($filename, File::get($file));
        dd($response);
    }
}
