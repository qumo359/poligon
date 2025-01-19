<?php

namespace App\Repositories;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 *
 * @package App\Repositories
 */
class BlogCategoryRepository extends CoreRepository
{
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * Получить модель для редактирования в админке.
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEdit(int $id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Получить список категорий для вывода в выпадающем списке.
     *
     * @return Collection
     */
    public function getForComboBox(): Collection
    {
        return $this->startConditions()->all();
    }

    /**
     * Получить категории для вывода пагинатором
     *
     * @param int|null $perPage
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];


        $result = $this
            ->startConditions()
            ->select($columns)
            ->with([
                'parentCategory:id,title'
            ])
            ->paginate($perPage);

        return $result;
    }
}

