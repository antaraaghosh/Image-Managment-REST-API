<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImagesController extends Controller
{
    public function index()
    {
        $images = Image::all();

        return response()->json($images);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'description' => 'nullable|string|max:255',
        ]);

         $image = $request->file('image');
         $imageName = time() . '.' . $image->getClientOriginalExtension();
         $image->storeAs('public/images', $imageName);


        $image = Image::create([
            'filename' => $imageName,
            'description' => $request->input('description'),
        ]);

        return response()->json($image);
    }

    public function show(Image $image)
    {
        return response()->json($image);
    }

    public function update(Request $request, $id)
    {

       // Retrieve the record that you want to update from the database
           $image = Image::find($id);

           if($image){

                $filePath = $image->filename;;

                if ($request->hasFile('image')) {

                    $request->validate([
                        'image' => 'required|image|max:2048',
                        'description' => 'nullable|string|max:255',
                    ]);

                    $newimage = $request->file('image');
                    $newimageName = time() . '.' . $newimage->getClientOriginalExtension();
                    $newimage->storeAs('public/images', $newimageName);

                    // Delete the old image file from the public folder
                    \Storage::delete('public/images/'.$image->filename);

                        // Update the image record in the database with the new image path
                    $image->filename = $newimageName;
                    $image->save();

                    // Return a response indicating success or failure
                    return response()->json(['message' => 'Image updated successfully']);
                }else {
                    // Return an error response if no file was uploaded
                    return response()->json(['message' => 'No file uploaded'], 400);
                }

           }else{

            return response()->json(['message' => 'No file found'], 400);

           }

          

       
    }

    public function destroy($id)
    {
        
        try{

            $image = Image::find($id);

            if($image){
                \Storage::delete('public/images/'.$image->filename);
                $image->delete();
            }else{
                return response()->json(['message' => 'No file found'], 400);
            }
            
    
            return response()->json(['message' => 'Image deleted']);
        }catch(exception $e){
            return response()->json(['message' => 'Unauthorized']);
        }
       
    }
}

