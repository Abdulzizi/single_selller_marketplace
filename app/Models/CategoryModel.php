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
        return $this->find($id)->update($payload);
    }

    public function getAll(array $filter, int $itemPerPage = 0, string $sort = '')
    {
        $categories = $this->query();

        if (!empty($filter['name'])) {
            $categories->where('name', 'LIKE', '%' . $filter['name'] . '%');
        }

        $sort = $sort ?: 'id DESC';
        $categories->orderByRaw($sort);
        $itemPerPage = ($itemPerPage > 0) ? $itemPerPage : false;

        return $categories->paginate($itemPerPage)->appends('sort', $sort);
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
