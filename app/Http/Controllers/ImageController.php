<?php

namespace App\Http\Controllers;

use App\image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{


    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'picture' => 'required|image',
        ]);

        if($request->hasFile('picture')) {

            $path = $request->file('picture')->store('picture');

            $image = new image();
            // $image->path = $path;
            $image->path = $path;
            $image->image_url = Storage::url($path);
            $image->name = $request->file('picture')->getClientOriginalName();
            $image->real_states_id = $id;

            $image->save();
    }
    return $image;
    }

    public function destroy($id)
    {
        $img = image::findOrFail($id);
        Storage::delete($img->path);
        $img->delete();

        return 'deleted';
    }

}
