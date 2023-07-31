<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'output' => $validator->errors()->first()]);
            }

            $userId = auth()->user()->id;
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $fileName = $uniqueText = substr(md5(uniqid(mt_rand(0, 9999), true)), 0, 10) . '.' . $extension;

            $path = $image->storeAs('images/' . $userId .'/', $fileName, 'public');


            return response()->json(['success' => true, 'url' => $path]);
        } catch (\Exception $ex) {
            return response()->json(['success' => true, 'output' => null]);
        }
    }
}
