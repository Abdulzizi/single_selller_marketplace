<?php

namespace App\Http\Controllers\ClientViews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('pages.landing-page');
    }
}
