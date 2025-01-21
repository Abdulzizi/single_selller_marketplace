<?php

namespace App\Http\Controllers\api;

use App\Helpers\Category\CategoryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryHelper;


    public function __construct()
    {
        $this->categoryHelper = new CategoryHelper();
    }

    public function index(Request $request)
    {
        $filter = [
            'name' => $request->name ?? '',
        ];
        $categories = $this->categoryHelper->getAll($filter, $request->page ?? 1, $request->per_page ?? 25, $request->sort ?? '');

        return response()->success([
            'list' => CategoryResource::collection($categories['data']['data']),
            'meta' => [
                'total' => $categories['data']['total'],
            ]
        ]);
    }

    public function show($id)
    {
        $category = $this->categoryHelper->getById($id);

        if (!($category['status'])) {
            return response()->failed(['Data category tidak ditemukan'], 404);
        }

        return response()->success(new CategoryResource($category['data']));
    }

    public function store(CategoryRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors());
        }

        $payload = $request->only(['name', 'description']);
        $category = $this->categoryHelper->create($payload);

        if (!$category['status']) {
            return response()->failed($category['error']);
        }

        return response()->success(new CategoryResource($category['data']), 'category berhasil ditambahkan');
    }

    public function update(CategoryRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->failed($request->validator->errors());
        }

        $payload = $request->only(['name', 'id']);
        $category = $this->categoryHelper->update($payload, $payload['id'] ?? 0);

        if (!$category['status']) {
            return response()->failed($category['error']);
        }

        return response()->success(new CategoryResource($category['data']), 'category berhasil diubah');
    }

    public function destroy($id)
    {
        $category = $this->categoryHelper->delete($id);

        if (!$category) {
            return response()->failed(['Mohon maaf category tidak ditemukan']);
        }

        return response()->success($category, 'category berhasil dihapus');
    }
}
