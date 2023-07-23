<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    // Show the settings form
    public function index()
    {
        // Retrieve the first record from the 'settings' table
        $setting = Setting::first();
        // Return the view with the settings data
        return view('admin.setting.index', compact('setting'));
    }

    // Store or update the settings data
    public function store(Request $request)
    {
        $request->validate([
            // Add your validation rules for other fields here
            'website_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Retrieve the first record from the 'settings' table
        $setting = Setting::first();

        // Prepare the data to be updated
        $data = [
            'website_name' => $request->website_name,
            'website_url' => $request->website_url,
            'page_title' => $request->page_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'address' => $request->address,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'email1' => $request->email1,
            'email2' => $request->email2,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
        ];

        // Handle the website logo update if a new logo image is uploaded
        if ($request->hasFile('website_logo')) {
            $uploadPath = 'uploads/website-logo/';
            $logoFile = $request->file('website_logo');
            $extension = $logoFile->getClientOriginalExtension();
            $filename = 'logo.' . $extension;
            $logoFile->move($uploadPath, $filename);
            $finalLogoPath = $uploadPath . $filename;

            // Delete the old logo file if it exists
            // if ($setting && File::exists(public_path($setting->logo))) {
            //     File::delete(public_path($setting->logo));
            // }

            // Update the logo path in the 'settings' table
            $data['logo'] = $finalLogoPath;
        }

        // Update or create the settings record with the prepared data
        if ($setting) {
            $setting->update($data);
        } else {
            Setting::create($data);
        }

        return redirect()->back()->with('message',
            'Settings Saved'
        );
    }
}
