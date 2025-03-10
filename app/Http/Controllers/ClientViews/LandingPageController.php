<?php

namespace App\Http\Controllers\ClientViews;

use App\Helpers\Category\CategoryHelper;
use App\Helpers\Product\ProductHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    private $productHelper;
    private $categoriesHelper;

    public function __construct()
    {
        $this->productHelper = new ProductHelper();
        $this->categoriesHelper = new CategoryHelper();
    }

    public function index()
    {
        $products = $this->productHelper->getAll([], 1, 6);
        $categories = $this->categoriesHelper->getAll([], 1, 6);

        // dd(($categories));
        return view('pages.landing-page', compact('products', 'categories'));
    }

    public function loadMore(Request $request)
    {
        $page = $request->input('page', 1);
        $products = $this->productHelper->getAll([], $page, 6);

        // Render the new products as an HTML string
        $html = view('components.product-grid-items', compact('products'))->render();

        return response()->json([
            'html' => $html,
            'hasMore' => count($products['data']['data']) > 0 // If no more products, hide the button
        ]);
    }
}
