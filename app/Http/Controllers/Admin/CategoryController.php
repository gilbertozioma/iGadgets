<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    public function index()
    {
        // Display the index view for category management
        return view('admin.category.index');
    }

    public function create()
    {
        // Display the create view for adding a new category
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        // Validate the incoming request using the specified form request

        // Get the validated data from the request
        $validatedData = $request->validated();

        // Create a new Category instance
        $category = new Category;
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        $uploadPath = 'uploads/category/';
        // Check if an image file is present in the request
        if ($request->hasFile('image')) {
            // Get the file and its extension
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            // Move the file to the designated upload path
            $file->move('uploads/category/', $filename);

            // Store the file path in the category's 'image' attribute
            $category->image = $uploadPath . $filename;
        }

        // Set other category attributes
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        // Set the status based on the value of the 'status' checkbox
        $category->status = $request->status == true ? '1' : '0';

        // Save the category instance to the database
        $category->save();

        // Redirect back to the category index view with a success message
        return redirect('admin/category')->with('message', 'Category Added Successfully');
    }

    public function edit(Category $category)
    {
        // Display the edit view for a specific category
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category)
    {
        // Validate the incoming request using the specified form request

        // Get the validated data from the request
        $validatedData = $request->validated();

        // Find the category instance to be updated
        $category = Category::findOrFail($category);

        // Update the category attributes with the new values
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        // Check if a new image file is present in the request
        if ($request->hasFile('image')) {
            // Get the file and its extension
            $uploadPath = 'uploads/category/';

            // Delete the old image file from the server if it exists
            $path = 'uploads/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            // Move the new file to the designated upload path
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            $file->move('uploads/category/', $filename);
            // Store the file path in the category's 'image' attribute
            $category->image = $uploadPath . $filename;
        }

        // Set other category attributes
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        // Set the status based on the value of the 'status' checkbox
        $category->status = $request->status == true ? '1' : '0';

        // Save the updated category instance to the database
        $category->update();

        // Redirect back to the category index view with a success message
        return redirect('admin/category')->with('message', 'Category Updated Successfully');
    }
}
