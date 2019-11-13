<?php

namespace App\Services;

class SearchService
{

    private $sortBy = 'id';
    private $sortDirection = 'desc';

    public function search($model)
    {
        $namespacedModel = '\\App\\' . $model;

        if (request()->has('sortBy')) {
            $this->sortBy = request()->sortBy;
        }

        if (request()->has('sortDirection')) {
            $this->sortDirection = request()->sortDirection;
        }

        $search = $namespacedModel::orderBy($this->sortBy, $this->sortDirection);

        if (request()->has('searchBy')) {
            $search = $namespacedModel::where(function ($query) {
                foreach (request()->searchBy as $searchKey => $searchValue) {
                    $query->where($searchKey, 'LIKE', '%' . $searchValue . '%');
                }
            })->orderBy($this->sortBy, $this->sortDirection);
        }

        return $search->paginate(10);
    }
}
