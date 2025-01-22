<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Cart\CartHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartRequest;
use App\Http\Resources\Cart\CartResource;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartHelper;

    public function __construct()
    {
        $this->cartHelper = new CartHelper();
    }

    public function index(Request $request)
    {
        $filter = [
            'user_id' => $request->user_id ?? '',
            'product_id' => $request->product_id ?? '',
            'product_detail_id' => $request->product_detail_id ?? '',
        ];

        $carts = $this->cartHelper->getAll($filter, $request->page ?? 1, $request->per_page ?? 25, $request->sort ?? '');

        return response()->success([
            'list' => CartResource::collection($carts['data']['data']),
            'meta' => [
                'total' => $carts['data']['total'],
            ]
        ]);
    }

    public function show($id)
    {
        $cart = $this->cartHelper->getById($id);

        if (!($cart['status'])) {
            return response()->failed(['Data cart$cart tidak ditemukan'], 404);
        }

        return response()->success(new CartResource($cart['data']));
    }

    public function store(CartRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors());
        }

        $payload = $request->only(['user_id', 'product_id', 'product_detail_id', 'quantity']);
        $cart = $this->cartHelper->create($payload);

        if (!$cart['status']) {
            return response()->failed($cart['error']);
        }

        return response()->success(new CartResource($cart['data']), 'cart berhasil ditambahkan');
    }

    public function update(CartRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors());
        }

        $payload = $request->only(['name', 'id']);
        $cart = $this->cartHelper->update($payload, $payload['id'] ?? 0);

        if (!$cart['status']) {
            return response()->failed($cart['error']);
        }

        return response()->success(new CartResource($cart['data']), 'cart berhasil diubah');
    }

    public function destroy($id)
    {
        $cart = $this->cartHelper->delete($id);

        if (!$cart) {
            return response()->failed(['Mohon maaf cart tidak ditemukan']);
        }

        return response()->success($cart, 'cart berhasil dihapus');
    }
}
