<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ckeditorUpload(Request $request)
    {
        if (!$request->hasFile('upload')) {
            return response()->json([
                'uploaded' => 0,
                'error' => ['message' => 'Không có tệp nào được tải lên.']
            ]);
        }

        $file = $request->file('upload');
        $filename = now()->timestamp . '_' . $file->getClientOriginalName();
        $filePath = "uploads/news/{$filename}";

        $file->storeAs('uploads/news', $filename, 'public');

        return response()->json([
            'uploaded' => 1,
            'fileName' => $filename,
            'url' => asset("storage/{$filePath}"),
        ]);
    }
}
