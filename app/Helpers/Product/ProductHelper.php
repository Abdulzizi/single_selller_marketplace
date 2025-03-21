<?php

namespace App\Helpers\Product;

use App\Helpers\Venturo;
use App\Models\ProductDetailModel;
use App\Models\ProductModel;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Throwable;

class ProductHelper extends Venturo
{
    const PRODUCT_PHOTO_DIRECTORY = 'foto-produk';
    private $productModel;
    private $productDetailModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->productDetailModel = new ProductDetailModel();
    }

    public function create(array $payload): array
    {
        try {
            $payload = $this->uploadAndGetPayload($payload);

            $this->beginTransaction();

            $product = $this->productModel->store($payload);

            $this->insertUpdateDetail($payload['details'] ?? [], $product->id);

            $this->commitTransaction();

            return [
                'status' => true,
                'data' => $product
            ];
        } catch (Throwable $th) {
            $this->rollbackTransaction();

            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }

    public function delete(string $productId)
    {
        try {
            $this->beginTransaction();

            $this->productModel->drop($productId);

            $this->productDetailModel->dropByProductId($productId);

            $this->commitTransaction();

            return [
                'status' => true,
                'data' => $productId
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
        $products = $this->productModel->getAll($filter, $page, $itemPerPage, $sort);

        return [
            'status' => true,
            'data' => $products
        ];
    }

    public function getById(string $id): array
    {
        $product = $this->productModel->getById($id);
        if (empty($product)) {
            return [
                'status' => false,
                'data' => null
            ];
        }

        return [
            'status' => true,
            'data' => $product
        ];
    }


    public function getBySlug(string $slug): array
    {
        $product = $this->productModel->where('slug', $slug)->first();
        if (empty($product)) {
            return [
                'status' => false,
                'data' => null
            ];
        }

        return [
            'status' => true,
            'data' => $product
        ];
    }

    public function update(array $payload): array
    {
        try {
            $payload = $this->uploadAndGetPayload($payload);

            $this->beginTransaction();

            $this->productModel->edit($payload, $payload['id']);

            $this->insertUpdateDetail($payload['details'] ?? [], $payload['id']);
            $this->deleteDetail($payload['details_deleted'] ?? []);

            $product = $this->getById($payload['id']);
            $this->commitTransaction();

            return [
                'status' => true,
                'data' => $product['data']
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
            $this->productDetailModel->drop($val['id']);
        }
    }

    // Private method untuk insert / update detail product
    private function insertUpdateDetail(array $details, string $productId)
    {
        if (empty($details)) {
            return false;
        }

        foreach ($details as $val) {
            // Insert
            if (isset($val['is_added']) && $val['is_added']) {
                $val['product_id'] = $productId;
                $this->productDetailModel->store($val);
            }

            // Update
            if (isset($val['is_updated']) && $val['is_updated']) {
                $this->productDetailModel->edit($val, $val['id']);
            }
        }
    }

    private function uploadAndGetPayload(array $payload)
    {
        // Desktop
        if (!empty($payload['photo_desktop'])) {
            $uploadedFileUrl = Cloudinary::upload($payload['photo_desktop']->getRealPath())->getSecurePath();

            $payload['photo_desktop'] = $uploadedFileUrl;
        } else {
            unset($payload['photo_desktop']);
        }

        // Mobile
        if (!empty($payload['photo_mobile'])) {
            $uploadedFileUrl = Cloudinary::upload($payload['photo_mobile']->getRealPath())->getSecurePath();

            $payload['photo_mobile'] = $uploadedFileUrl;

            // Cloudinary::destroy($payload['photo_desktop']);
        } else {
            unset($payload['photo_mobile']);
        }

        return $payload;
    }
}
