<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    public function downloadImage($filename)
    {
        $path = public_path('images/' . $filename);

        if (!File::exists($path)) {
            abort(404, 'Image not found');
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        $response->header("Content-Disposition", "attachment; filename=$filename");

        return $response;
    }
}
