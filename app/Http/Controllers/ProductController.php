<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){

        return Inertia::render('product/index');
    }
    public function create(){
        
        return Inertia::render('product/create');
    }
    public function getAllProductIds()
    {
        // Retrieve all product IDs
        $productIds = Product::pluck('id'); // or you can specify the column like 'id'
        
        // Return as JSON (or pass it to a view if needed)
        return response()->json($productIds);
    }
    public function getAllProducts(){
        $products = Product::pluck('id'); // or you can specify the column like 'id'
        
        // Return as JSON (or pass it to a view if needed)
        return response()->json($products);
    }
    public function get_product_with_id($id)
    {
        try {
            // Retrieve the product by its ID from the database
            $product = Product::findOrFail($id);
            
            // Return product data as JSON response
            return response()->json($product);
        } catch (\Exception $e) {
            // Handle any errors (e.g., product not found)
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
}
