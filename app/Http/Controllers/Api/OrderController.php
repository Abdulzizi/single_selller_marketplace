<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Order\OrderHelper;
use App\Helpers\Product\ProductHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;
use App\Http\Resources\Order\OrderResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderHelper;
    private $productHelper;
    public function __construct()
    {
        $this->productHelper = new ProductHelper();
        $this->orderHelper = new OrderHelper();
    }

    public function index(Request $request)
    {
        $filter = [
            'id' => $request->id ?? '',
            'user_id' => $request->user_id ?? '',
            'product_detail_id' => $request->product_detail_id ?? '',
            'status' => isset($request->status) ? $request->status : '',
        ];
        $orders = $this->orderHelper->getAll($filter, $request->page ?? 1, $request->per_page ?? 25, $request->sort ?? '');

        return response()->success([
            'list' => OrderResource::collection($orders['data']['data']),
            'meta' => [
                'total' => $orders['data']['total'],
            ]
        ]);
    }

    public function store(OrderRequest $request)
    {
        if ($request->validator?->fails()) {
            return response()->failed($request->validator->errors());
        }

        // $payload = $request->only(['id', 'user_id', 'product_detail_id', 'status', 'details', 'details_deleted']);

        // Remove status
        $payload = $request->only([
            'user_id',
            'product_detail_id',
            // 'total_price',
            'details',
            'details_deleted',
            'street',
            'apartment',
            'city',
            'postcode',
            'country',
            'payment_method',
            'payment_details'
        ]);

        // $payload = $request->only([
        //     'user_id',
        //     'product_detail_id',
        //     'total_price',
        //     'details',
        //     'details_deleted',
        //     'payment_method',
        //     'payment_details'
        // ]);

        // if ($request->has('delivery_details')) {
        //     $payload = array_merge($payload, $request->input('delivery_details'));
        // }

        $totalPrice = 0;

        foreach ($payload['details'] as &$detail) {
            $productResponse = $this->productHelper->getById($detail['product_id']);

            // Check apakah ada product
            if (!$productResponse['status'] || !isset($productResponse['data'])) {
                return response()->failed(["Product with ID {$detail['product_id']} not found"]);
            }

            $product = $productResponse['data'];

            $detail['price'] = $product['price'];
            $detail['total'] = $detail['price'] * ($detail['quantity'] ?? 1);
            $totalPrice += $detail['total'];
        }

        $payload['total_price'] = $totalPrice;

        // dd($payload);
        $orders = $this->orderHelper->create($payload);

        if (!$orders['status']) {
            return response()->failed($orders['error']);
        }

        return response()->success(new OrderResource($orders['data']), 'Order berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $order = $this->orderHelper->getById($id);

        if (!($order['status'])) {
            return response()->failed(['Data order tidak ditemukan'], 404);
        }

        return response()->success(new OrderResource($order['data']));
    }

    public function update(Request $request)
    {
        if ($request->validator?->fails()) {
            return response()->failed($request->validator->errors());
        }

        $payload = $request->only(['id', 'status', 'user_id', 'product_detail_id', 'details', 'details_deleted']);

        // Validate order existence
        $existingOrder = $this->orderHelper->getById($payload['id']);
        if (!$existingOrder['status']) {
            return response()->failed(['Order tidak ditemukan'], 404);
        }

        if (isset($payload['status']) && count($payload) === 2) {
            // Case 1: Status-Only Update
            $order = $this->orderHelper->updateStatus($payload);
        } else {
            // Case 2: Full Update
            $order = $this->orderHelper->update($payload);
        }

        if (!$order['status']) {
            return response()->failed($order['error']);
        }

        return response()->success(new OrderResource($order['data']), 'Order berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $order = $this->orderHelper->delete($id);

        if (!$order['status']) {
            return response()->failed(['Mohon maaf order tidak ditemukan']);
        }

        return response()->success($order, 'order berhasil dihapus');
    }
}
