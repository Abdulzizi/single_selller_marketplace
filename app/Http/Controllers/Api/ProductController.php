<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Product\ProductHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productHelper;
    public function __construct()
    {
        $this->productHelper = new ProductHelper();
    }

    public function index(Request $request)
    {
        $filter = [
            'name' => $request->name ?? '',
            'product_category_id' => !empty($request->product_category_id) ? explode(",", $request->product_category_id) : [],
            'is_available' => isset($request->is_available) ? $request->is_available : '',
            'min_price' => $request->min_price ?? '',
            'max_price' => $request->max_price ?? '',
        ];
        $products = $this->productHelper->getAll($filter, $request->page ?? 1, $request->per_page ?? 25, $request->sort ?? '');

        return response()->success([
            'list' => ProductResource::collection($products['data']['data']),
            'meta' => [
                'total' => $products['data']['total'],
            ]
        ]);
    }

    public function store(ProductRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors());
        }

        $payload = $request->only([
            'name',
            'price',
            'description',

            'photo_desktop',
            'photo_mobile',

            'is_available',
            'details',
            'product_category_id'
        ]);

        $payload['category_id'] = $payload['product_category_id'];
        $product = $this->productHelper->create($payload);

        if (!$product['status']) {
            return response()->failed($product['error']);
        }

        return response()->success(new ProductResource($product['data']), 'product berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $product = $this->productHelper->getById($id);

        if (!($product['status'])) {
            return response()->failed(['Data product tidak ditemukan'], 404);
        }

        return response()->success(new ProductResource($product['data']));
    }

    public function showBySlug(string $slug)
    {
        $product = $this->productHelper->getBySlug($slug);

        if (!($product['status'])) {
            return response()->failed(['Data product tidak ditemukan'], 404);
        }

        return response()->success(new ProductResource($product['data']));
    }

    public function update(ProductRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors());
        }

        $payload = $request->only([
            'name',
            'price',
            'description',

            'photo_desktop',
            'photo_mobile',

            'is_available',
            'details',
            'details_deleted',
            'id',
            'product_category_id'
        ]);

        // dd($payload);

        $payload['category_id'] = $payload['product_category_id'];

        $product = $this->productHelper->update($payload);

        if (!$product['status']) {
            return response()->failed($product['error']);
        }

        return response()->success(new ProductResource($product['data']), 'product berhasil diubah');
    }

    public function destroy(string $id)
    {
        $product = $this->productHelper->delete($id);

        if (!$product['status']) {
            return response()->failed(['Mohon maaf product tidak ditemukan']);
        }

        return response()->success($product, 'product berhasil dihapus');
    }
}
