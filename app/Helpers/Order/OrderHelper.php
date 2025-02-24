<?php

namespace App\Helpers\Order;

use App\Helpers\Venturo;
use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use Throwable;

class OrderHelper extends Venturo
{
    private $orderModel;
    private $orderDetailModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->orderDetailModel = new OrderDetailModel();
    }

    public function create(array $payload): array
    {
        try {
            // dd($payload);

            $this->beginTransaction();

            $order = $this->orderModel->store($payload);

            $this->insertUpdateDetail($payload['details'] ?? [], $order->id);

            $this->commitTransaction();

            return [
                'status' => true,
                'data' => $order
            ];
        } catch (Throwable $th) {
            $this->rollbackTransaction();

            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }

    public function delete(string $orderId)
    {
        try {
            $this->beginTransaction();

            $this->orderModel->drop($orderId);

            $this->orderDetailModel->dropByOrderId($orderId);

            $this->commitTransaction();

            return [
                'status' => true,
                'data' => $orderId
            ];
        } catch (Throwable $th) {
            $this->rollbackTransaction();

            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }

    public function getAll(array $filter, int $page = 1, int $itemPerPage = 0, string $sort = '')
    {
        $orders = $this->orderModel->getAll($filter, $page, $itemPerPage, $sort);

        return [
            'status' => true,
            'data' => $orders
        ];
    }

    public function getById(string $id): array
    {
        $order = $this->orderModel->getById($id);
        if (empty($order)) {
            return [
                'status' => false,
                'data' => null
            ];
        }

        return [
            'status' => true,
            'data' => $order
        ];
    }

    // public function getProductById(string $productId)
    // {
    //     return ProductModel::find($productId);
    // }

    public function update(array $payload): array
    {
        try {
            $this->beginTransaction();

            $this->orderModel->edit($payload, $payload['id']);

            $this->insertUpdateDetail($payload['details'] ?? [], $payload['id']);
            $this->deleteDetail($payload['details_deleted'] ?? []);

            $order = $this->getById($payload['id']);
            $this->commitTransaction();

            return [
                'status' => true,
                'data' => $order['data']
            ];
        } catch (Throwable $th) {
            $this->rollbackTransaction();

            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }

    public function updateStatus(array $payload): array
    {
        try {
            $this->beginTransaction();

            $this->orderModel->edit(['status' => $payload['status']], $payload['id']);

            $order = $this->getById($payload['id']);
            $this->commitTransaction();

            return [
                'status' => true,
                'data' => $order['data']
            ];
        } catch (Throwable $th) {
            $this->rollbackTransaction();

            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }

    // Private method untuk delete detail product
    private function deleteDetail(array $details)
    {
        if (empty($details)) {
            return false;
        }

        foreach ($details as $val) {
            $this->orderDetailModel->drop($val['id']);
        }
    }

    // Private method untuk insert / update detail product
    private function insertUpdateDetail(array $details, string $orderId)
    {
        if (empty($details)) {
            return false;
        }

        foreach ($details as $val) {
            // Insert
            if (isset($val['is_added']) && $val['is_added']) {
                $val['order_id'] = $orderId;
                $this->orderDetailModel->store($val);
            }

            // Update
            if (isset($val['is_updated']) && $val['is_updated']) {
                $this->orderDetailModel->edit($val, $val['id']);
            }
        }
    }
}
