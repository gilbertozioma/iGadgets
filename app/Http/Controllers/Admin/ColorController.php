<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;

class ColorController extends Controller
{
    public function index()
    {
        // Retrieve all colors from the database
        $colors = Color::all();

        // Display the index view for color management and pass the colors data to the view
        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        // Display the create view for adding a new color
        return view('admin.colors.create');
    }

    public function store(ColorFormRequest $request)
    {
        // Validate the incoming request using the specified form request

        // Get the validated data from the request
        $validatedData = $request->validated();

        // Set the 'status' attribute based on the value of the 'status' checkbox
        $validatedData['status'] = $request->status == true ? '1' : '0';

        // Create a new Color instance and store it in the database
        Color::create($validatedData);

        // Redirect back to the colors index view with a success message
        return redirect('admin/colors')->with('message', 'Color Added Successfully');
    }

    public function edit(Color $color)
    {
        // Display the edit view for a specific color and pass the color data to the view
        return view('admin.colors.edit', compact('color'));
    }

    public function update(ColorFormRequest $request, $color_id)
    {
        // Validate the incoming request using the specified form request

        // Get the validated data from the request
        $validatedData = $request->validated();

        // Set the 'status' attribute based on the value of the 'status' checkbox
        $validatedData['status'] = $request->status == true ? '1' : '0';

        // Find the color instance to be updated and update its attributes with the new values
        Color::find($color_id)->update($validatedData);

        // Redirect back to the colors index view with a success message
        return redirect('admin/colors')->with('message', 'Color Updated Successfully');
    }

    public function destroy($color_id)
    {
        // Find the color instance to be deleted
        $color = Color::findOrFail($color_id);

        // Delete the color from the database
        $color->delete();

        // Redirect back to the colors index view with a success message
        return redirect('admin/colors')->with('message', 'Color Deleted Successfully');
    }
}
