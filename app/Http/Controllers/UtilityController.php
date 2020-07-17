<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App;

class UtilityController extends Controller
{
    public function changeLocale(Request $request) 
    {
        if ($request->ajax()) {
            $la = $request->all();
            App::setLocale($la['locale']);
            $request->session()->put('locale', $la['locale']);
        } 
        return response()->json([
            'result' => 'success'
        ]);
    }

    public function getResource($any, $filename) {
        $path = $any . '/' . $filename;
        if (Storage::disk('images')->exists($path)) {
            $file = Storage::disk('images')->get($path);
            return response($file)->header('Content-Type', 'image/jpeg');
        } else if (Storage::disk('markdown')->exists($path)) {
            $file = Storage::disk('markdown')->get($path);
            return response($file)->header('Content-Type', 'text/plain');
        } else {
            return response()->json([]);
        }
    }
}
