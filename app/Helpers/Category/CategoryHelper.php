<?php

namespace App\Helpers\Category;

use App\Helpers\Venturo;
use App\Models\CategoryModel;
use Throwable;

/**
 * Helper untuk manajemen categories
 * Mengambil data, menambah, mengubah, & menghapus ke tabel categories
 *
 */
class CategoryHelper extends Venturo
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function create(array $payload): array
    {
        try {
            $category = $this->categoryModel->store($payload);

            return [
                'status' => true,
                'data' => $category
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
            $this->categoryModel->drop($id);

            return true;
        } catch (Throwable $th) {
            return false;
        }
    }

    public function getAll(array $filter, int $page = 1, int $itemPerPage = 0, string $sort = '')
    {
        $categories = $this->categoryModel->getAll($filter, $page, $itemPerPage, $sort);

        return [
            'status' => true,
            'data' => $categories
        ];
    }

    public function getById(string $id): array
    {
        $category = $this->categoryModel->getById($id);
        if (empty($category)) {
            return [
                'status' => false,
                'data' => null
            ];
        }

        return [
            'status' => true,
            'data' => $category
        ];
    }

    public function update(array $payload, string $id): array
    {
        try {
            $this->categoryModel->edit($payload, $id);

            $category = $this->getById($id);

            return [
                'status' => true,
                'data' => $category['data']
            ];
        } catch (Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }
}
