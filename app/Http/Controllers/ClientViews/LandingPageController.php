<?php

namespace App\Http\Controllers\ClientViews;

use App\Helpers\Product\ProductHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    private $productHelper;
    public function __construct()
    {
        $this->productHelper = new ProductHelper();
    }

    public function index()
    {
        $products = $this->productHelper->getAll([], 1, 12);
        // dd(json_encode($products));
        return view('pages.landing-page', compact('products'));
    }
}
