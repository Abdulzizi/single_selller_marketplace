<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'total_sales' => $this['total_sales'],
            'new_users' => $this['new_users'],
            'orders' => $this['orders'],
            'revenue_distribution' => $this['revenue_distribution'],
        ];
    }
}
