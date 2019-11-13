<?php

namespace App\Services;

class SearchService
{

    public $sortBy = 'id';
    public $sortDirection = 'desc';

    public function search($request, $model)
    {
        $namespacedModel = '\\App\\' . $model;

        if ($request->sortBy) {
            $this->sortBy = $request->sortBy;
        }

        if ($request->sortDirection) {
            $this->sortDirection = $request->sortDirection;
        }

        $search = $namespacedModel::orderBy($this->sortBy, $this->sortDirection);

        if ($request->searchBy) {
            $search = $namespacedModel::where(function ($query) use ($request) {
                foreach ($request->searchBy as $searchKey => $searchValue) {
                    $query->where($searchKey, 'LIKE', '%' . $searchValue . '%');
                }
            })->orderBy($this->sortBy, $this->sortDirection);
        }

        return $search->paginate(10);
    }
}
