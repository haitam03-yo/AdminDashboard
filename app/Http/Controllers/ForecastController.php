<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Product;

class ForecastController extends Controller
{
    public function getPrediction($id = 'ALI-012022-020')
    {
        $products_id = Product::pluck('id'); // Fetch all product IDs

        return Inertia::render('forecast/product', [
            'products_id' => $products_id, // Pass the list of products
            'get_selected_product_id' => $id, // Pass the selected product details if available
        ]);
    }
    public function show($id, Request $request)
    {
        // Validate the incoming prediction data
        $validated = $request->validate([
            'predictionData' => 'required|array', // Ensure predictionData is an array
            'predictionData.*' => 'required',     // Ensure each item inside predictionData is required
        ]);
    
        // Retrieve the prediction data
        $predictionData = $validated['predictionData'];
    
        // Process the data if needed (e.g., format, filter, etc.)
        // You can also store it in a database or perform additional calculations if required
    
        // Return the Inertia view with the prediction data and product ID
        return Inertia::render('forecast/show', [
            'product_id' => $id, // Pass the product ID to the front-end
            'predictionData' => $predictionData, // Pass the prediction data to the front-end
        ]);
    }
    
    
}
