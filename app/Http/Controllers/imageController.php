<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class imageController extends Controller
{
   
     public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); 
        }

        // Save other form data as needed
        $name = $request->input('name');

        //$imagePath = str_replace('\\', '/', public_path('images/' . $imageName));
        $imagePath = asset('images/' . $imageName);
        return response()->json(['success' => true, 'image_path' => $imagePath]);

    }
    
}
