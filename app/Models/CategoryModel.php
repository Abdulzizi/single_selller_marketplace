<?php

namespace App\Models;

use App\Helpers\SlugHelper;
use App\Http\Traits\Uuid;
use App\Repository\CrudInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryModel extends Model implements CrudInterface
{
    use HasFactory;
    use SoftDeletes;
    use Uuid;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'slug'
    ];

    protected $table = 'categories';

    public function products()
    {
        return $this->hasMany(ProductModel::class, 'category_id', 'id');
    }

    public function drop(string $id)
    {
        return $this->find($id)->delete();
    }

    public function edit(array $payload, string $id)
    {
        $payload['slug'] = SlugHelper::createUniqueSlug($payload['name'], self::class);

        return $this->find($id)->update($payload);
    }

    public function getAll(array $filter, int $page = 1, int $itemPerPage = 0, string $sort = '')
    {
        $skip = ($page * $itemPerPage) - $itemPerPage;
        $category = $this->query();
        $total = $category->count();

        if (! empty($filter['name'])) {
            $category->where('name', 'LIKE', '%' . $filter['name'] . '%');
        }

        $sort = $sort ?: 'id DESC';
        $list = $category->skip($skip)->take($itemPerPage)->orderByRaw($sort)->get();

        return [
            'total' => $total,
            'data' => $list,
        ];
    }

    public function getById(string $id)
    {
        return $this->find($id);
    }

    public function store(array $payload)
    {
        $payload['slug'] = SlugHelper::createUniqueSlug($payload['name'], self::class);

        return $this->create($payload);
    }
}
