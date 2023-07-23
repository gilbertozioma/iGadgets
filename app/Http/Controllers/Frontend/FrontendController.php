<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{

    // Display the frontend index page.
    public function index()
    {
        // Get sliders where status is '0'.
        $sliders = Slider::where('status', '0')->get();

        // Get trending products (where 'trending' column is '1'), latest 15 items.
        $trendingProducts = Product::where('trending', '1')->latest()->take(15)->get();

        // Get latest new arrivals products (latest 14 items).
        $newArrivalsProducts = Product::latest()->take(14)->get();

        // Get latest featured products (where 'featured' column is '1'), latest 14 items.
        $featuredProducts = Product::where('featured', '1')->latest()->take(14)->get();

        // Return the view 'frontend.index' with the data collected above.
        return view('frontend.index', compact('sliders', 'trendingProducts', 'newArrivalsProducts', 'featuredProducts'));
    }

    
    // Search for products based on user input.
    public function searchProducts(Request $request)
    {
        // Check if the 'search' input field is not empty.
        if ($request->search) {
            // Search products where the 'name' column contains the user's search query, latest 15 items.
            $searchProducts = Product::where('name', 'LIKE', '%' . $request->search . '%')->latest()->paginate(15);
            // Return the view 'frontend.pages.search' with the search results.
            return view('frontend.pages.search', compact('searchProducts'));
        } else {
            // If the 'search' input field is empty, redirect back with a message.
            return redirect()->back()->with('message', 'Empty Search');
        }
    }

    
    // Display the new arrival products page.
    public function newArrival()
    {
        // Get latest new arrivals products (latest 16 items).
        $newArrivalsProducts = Product::latest()->take(16)->get();
        // Return the view 'frontend.pages.new-arrival' with the new arrival products.
        return view('frontend.pages.new-arrival', compact('newArrivalsProducts'));
    }

    
    // Display the featured products page.
    public function featuredProducts()
    {
        // Get latest featured products (where 'featured' column is '1').
        $featuredProducts = Product::where('featured', '1')->latest()->get();
        // Return the view 'frontend.pages.featured-products' with the featured products.
        return view('frontend.pages.featured-products', compact('featuredProducts'));
    }

    
    // Display the categories page.
    public function categories()
    {
        // Get categories where status is '0'.
        $categories = Category::where('status', '0')->get();
        // Return the view 'frontend.collections.category.index' with the categories.
        return view('frontend.collections.category.index', compact('categories'));
    }

    
    // Display the products page for a specific category.
    public function products($category_slug)
    {
        // Find the category based on the provided slug.
        $category = Category::where('slug', $category_slug)->first();
        // Check if the category exists.
        if ($category) {
            // Return the view 'frontend.collections.products.index' with the category.
            return view('frontend.collections.products.index', compact('category'));
        } else {
            // If the category does not exist, redirect back.
            return redirect()->back();
        }
    }

    
    // Display the product details page for a specific product in a specific category.
    public function productView(string $category_slug, string $product_slug)
    {
        // Find the category based on the provided slug.
        $category = Category::where('slug', $category_slug)->first();
        // Check if the category exists.
        if ($category) {
            // Find the product in the category based on the provided slug and where 'status' column is '0'.
            $product = $category->products()->where('slug', $product_slug)->where('status', '0')->first();
            // Check if the product exists.
            if ($product) {
                // Return the view 'frontend.collections.products.view' with the product and category.
                return view('frontend.collections.products.view', compact('product', 'category'));
            } else {
                // If the product does not exist, redirect back.
                return redirect()->back();
            }
        } else {
            // If the category does not exist, redirect back.
            return redirect()->back();
        }
    }

    
    // Display the thank-you page after a successful action.
    public function thankyou()
    {
        // Retrieve the website logo path from the 'settings' table
        $settings = Setting::first();
        $websiteLogo = $settings->logo ?? null; // Assuming the 'logo' column stores the logo path

        // Return the view 'frontend.thank-you' along with the logo path
        return view('frontend.thank-you', compact('websiteLogo'));
    }

}
