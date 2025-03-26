<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\DashboardHelper;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    private $dashboardHelper;

    public function __construct()
    {
        $this->dashboardHelper = new DashboardHelper();
    }

    public function index(): JsonResponse
    {
        $dashboardData = $this->dashboardHelper->getDashboardData();

        return response()->json([
            'status_code' => 200,
            'data' => $dashboardData
        ]);
    }
}
