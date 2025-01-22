<?php

namespace App\Helpers\Cart;

use App\Models\CartModel;
use Throwable;

class CartHelper
{
    private $cartModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
    }

    public function create(array $payload): array
    {
        try {
            $carts = $this->cartModel->store($payload);

            return [
                'status' => true,
                'data' => $carts
            ];
        } catch (Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }

    public function delete(string $id): bool
    {
        try {
            $this->cartModel->drop($id);

            return true;
        } catch (Throwable $th) {
            return false;
        }
    }

    public function getAll(array $filter, int $page = 1, int $itemPerPage = 0, string $sort = '')
    {
        $categories = $this->cartModel->getAll($filter, $page, $itemPerPage, $sort);

        return [
            'status' => true,
            'data' => $categories
        ];
    }

    public function getById(string $id): array
    {
        $carts = $this->cartModel->getById($id);
        if (empty($carts)) {
            return [
                'status' => false,
                'data' => null
            ];
        }

        return [
            'status' => true,
            'data' => $carts
        ];
    }

    public function update(array $payload, string $id): array
    {
        try {
            $this->cartModel->edit($payload, $id);

            $carts = $this->getById($id);

            return [
                'status' => true,
                'data' => $carts['data']
            ];
        } catch (Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }
}
