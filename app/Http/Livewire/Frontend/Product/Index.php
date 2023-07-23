<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    // Variables to store product data and filter inputs
    public $products, $category, $brandInputs = [], $priceInput;

    // Set the query string parameters for filtering
    protected $queryString = [
        'brandInputs' => ['except' => '', 'as' => 'brand'],
        'priceInput' => ['except' => '', 'as' => 'price'],
    ];

    // Method to set the category on component mount
    public function mount($category)
    {
        $this->category = $category;
    }
    public function render()
    {
        // Query the products based on the selected category and applied filters
        $this->products = Product::where('category_id', $this->category->id)
            // Apply a conditional query based on the selected brand inputs
            ->when($this->brandInputs, function ($q) {
                // If brandInputs array is not empty, filter products by the selected brands
                $q->whereIn('brand', $this->brandInputs);
            })
            // Apply a conditional query based on the selected price input
            ->when($this->priceInput, function ($q) {
                $q->when($this->priceInput == 'high-to-low', function ($q2) {
                    // If priceInput is 'high-to-low', order products by selling price in descending order
                    $q2->orderBy('selling_price', 'DESC');
                })
                ->when($this->priceInput == 'low-to-high', function ($q2) {
                    // If priceInput is 'low-to-high', order products by selling price in ascending order
                    $q2->orderBy('selling_price', 'ASC');
                });
            })
            // Filter products with 'status' equal to '0'
            ->where('status', '0')
            // Get the results of the query as a collection
            ->get();
            
        // Render the view with the filtered products and category
        return view('livewire.frontend.product.index', [
            'products' => $this->products,
            'category' => $this->category,
        ]);
    }
}
