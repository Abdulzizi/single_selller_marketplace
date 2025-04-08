<?php

namespace App\Helpers;

use App\Models\OrderModel;
use App\Models\OrderDetailModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class DashboardHelper
{
    private $userModel;
    private $orderModel;
    private $orderDetailModel;
    private $productModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->orderModel = new OrderModel();
        $this->orderDetailModel = new OrderDetailModel();
        $this->productModel = new ProductModel();
    }

    public function getDashboardData(): array
    {
        return [
            'total_sales' => $this->getTotalSales(),
            'new_users' => $this->getNewUsers(),
            'orders' => $this->getOrders(),
            'revenue_distribution' => $this->getRevenueDistribution(),
        ];
    }

    private function getTotalSales(): array
    {
        return $this->orderDetailModel
            ->selectRaw('SUM(total) as sales, DATE_FORMAT(created_at, "%Y-%m") as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($row) {
                return [
                    'month' => $row->month,
                    'value' => (float) $row->sales,
                ];
            })
            ->toArray();
    }


    private function getNewUsers(): array
    {
        return $this->userModel
            ->selectRaw('COUNT(id) as count, DATE_FORMAT(created_at, "%Y-%m") as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($row) {
                return [
                    'month' => $row->month,
                    'value' => (int) $row->count,
                ];
            })
            ->toArray();
    }


    private function getOrders(): array
    {
        return $this->orderModel
            ->selectRaw('COUNT(id) as count, DATE_FORMAT(created_at, "%Y-%m") as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($row) {
                return [
                    'month' => $row->month,
                    'value' => (int) $row->count,
                ];
            })
            ->toArray();
    }


    private function getRevenueDistribution(): array
    {
        return $this->productModel
            ->join('order_details', 'products.id', '=', 'order_details.product_id')
            ->selectRaw('products.name, SUM(order_details.total) as revenue')
            ->groupBy('products.name')
            ->pluck('revenue', 'products.name')
            ->toArray();
    }
}
