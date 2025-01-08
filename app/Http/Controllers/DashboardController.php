<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Products2;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
{
    $productCount = Products2::count();
    $totalQuantitySold = Products2::sum('quantite_vendue');
    $totalStock = Products2::sum('stock_disponible');

    $bestSellingCategory = Products2::select('categorie', DB::raw('SUM(quantite_vendue) as total_sales'))
        ->groupBy('categorie')
        ->orderByDesc('total_sales')
        ->first();
    $bestSellingCategoryName = $bestSellingCategory ? mb_convert_encoding($bestSellingCategory->categorie, 'UTF-8', 'ISO-8859-1') : 'No Data';

    $bestSellingProduct = Products2::select('id_produit', DB::raw('SUM(quantite_vendue) as total_sales'))
        ->groupBy('id_produit')
        ->orderByDesc('total_sales')
        ->first();
    $bestSellingProductName = $bestSellingProduct ? mb_convert_encoding($bestSellingProduct->id_produit, 'UTF-8', 'ISO-8859-1') : 'No Data';

    $topSoldProducts = Products2::select('id_produit', 'date', DB::raw('SUM(quantite_vendue) as total_sales'))
        ->groupBy('id_produit')
        ->orderByDesc('total_sales')
        ->limit(5)
        ->get();

    $topSoldProductsArray = $topSoldProducts->map(function ($item) {
        return array_map(function ($value) {
            // Ensure all strings are UTF-8 encoded
            return mb_convert_encoding($value, 'UTF-8', 'ISO-8859-1');
        }, $item->toArray());
    });

    // Fetch top-selling products in the last 30 days before the last available date
    $topSoldBrand = Products2::select('marque', DB::raw('SUM(quantite_vendue) as total_sales'))
        ->groupBy('marque')
        ->orderByDesc('total_sales')
        ->limit(5)
        ->get();

    $topSoldBrand_Array = $topSoldBrand->map(function ($item) {
        return array_map(function ($value) {
            // Ensure all strings are UTF-8 encoded
            return mb_convert_encoding($value, 'UTF-8', 'ISO-8859-1');
        }, $item->toArray());
    });

    

    return Inertia::render('Dashboard', [
        'productCount' => $productCount,
        'totalQuantitySold' => $totalQuantitySold,
        'totalStock' => $totalStock,
        'bestSellingCategory' => $bestSellingCategoryName,
        'bestSellingProduct' => $bestSellingProductName,
        'topSoldProducts' => $topSoldProductsArray,
        'topSoldBrand' => $topSoldBrand_Array,
        
    ]);
    
}

}
