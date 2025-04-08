<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\DashboardHelper;
use App\Http\Resources\Dashboard\DashboardResource;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    private $dashboardHelper;

    public function __construct()
    {
        $this->dashboardHelper = new DashboardHelper();
    }

    public function index()
    {
        $dashboardData = $this->dashboardHelper->getDashboardData();

        return response()->success([
            'list' => new DashboardResource($dashboardData),
            // 'meta' => [
            //     'total' => count($dashboardData['new_users']),
            // ],
        ]);
    }
}
