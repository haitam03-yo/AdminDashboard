<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Product;

class ForecastController extends Controller
{
    public function getPrediction($id = null)
    {
        $products_id = Product::pluck('id'); // Fetch all product IDs
    
        // If a specific product ID is provided, retrieve its details (optional)
        $selectedProduct = $id ? Product::find($id) : null;
    
        return Inertia::render('forecast/product', [
            'products_id' => $products_id, // Pass the list of products
            'selectedProduct' => $selectedProduct, // Pass the selected product details if available
        ]);
    }
    
}
