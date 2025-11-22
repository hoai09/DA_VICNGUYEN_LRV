<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function ckeditorUpload(Request $request)
    {
        if ($request->hasFile('upload')) {

            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('uploads/news', $filename, 'public');

            $url = asset("storage/uploads/news/$filename");

            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => $url
            ]);
        }

        return response()->json([
            'uploaded' => 0,
            'error' => ['message' => 'No file uploaded']
        ]);
    }
}
