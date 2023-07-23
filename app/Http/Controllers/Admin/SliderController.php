<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFormRequest;

class SliderController extends Controller
{
    // Show all sliders
    public function index()
    {
        // Retrieve all sliders from the 'sliders' table
        $sliders = Slider::all();
        // Return the view with the slider data
        return view('admin.slider.index', compact('sliders'));
    }

    // Show the form to create a new slider
    public function create()
    {
        // Return the view for creating a new slider
        return view('admin.slider.create');
    }

    // Store a new slider in the database
    public function store(SliderFormRequest $request)
    {
        // Validate the form data
        $validatedData = $request->validated();

        // Check if an image was uploaded
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/slider/', $filename);
            $validatedData['image'] = "uploads/slider/$filename";
        }

        // Set the status of the slider (active or inactive)
        $validatedData['status'] = $request->status == true ? '1' : '0';

        // Create a new slider record in the 'sliders' table
        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? null,
            'status' => $validatedData['status'],
        ]);

        // Redirect back to the sliders page with a success message
        return redirect('admin/sliders')->with('message', 'Slider Added Successfully');
    }

    // Show the form to edit a slider
    public function edit(Slider $slider)
    {
        // Return the view for editing the selected slider
        return view('admin.slider.edit', compact('slider'));
    }

    // Update a slider in the database
    public function update(SliderFormRequest $request, Slider $slider)
    {
        // Validate the form data
        $validatedData = $request->validated();

        // Check if a new image was uploaded
        if ($request->hasFile('image')) {
            // Delete the old image file from the server
            $destination = $slider->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            // Upload the new image and update the image path in the database
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/slider/', $filename);
            $validatedData['image'] = "uploads/slider/$filename";
        }

        // Set the status of the slider (active or inactive)
        $validatedData['status'] = $request->status == true ? '1' : '0';

        // Update the slider record in the 'sliders' table
        Slider::where('id', $slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? $slider->image,
            'status' => $validatedData['status'],
        ]);

        // Redirect back to the sliders page with a success message
        return redirect('admin/sliders')->with('message', 'Slider Updated Successfully');
    }

    // Delete a slider from the database and remove the associated image file
    public function destroy(Slider $slider)
    {
        // Check if the slider exists
        if ($slider->count() > 0) {
            // Delete the image file from the server
            $destination = $slider->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            // Delete the slider record from the 'sliders' table
            $slider->delete();
            // Redirect back to the sliders page with a success message
            return redirect('admin/sliders')->with('message', 'Slider Deleted Successfully');
        }

        // Redirect back to the sliders page with an error message if the slider does not exist
        return redirect('admin/sliders')->with('message', 'Something Went Wrong');
    }
}
