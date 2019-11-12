<?php

namespace App\Services;

class SearchService
{

    public $sortBy;
    public $sortDirection;

    public function __construct()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
    }

    public function search($request, $model)
    {
        $namespacedModel = '\\App\\' . $model;

        if ($request->sortBy) {
            $this->sortBy = $request->sortBy;
        }

        if ($request->sortDirection) {
            $this->sortDirection = $request->sortDirection;
        }

        if ($request->searchBy) {
            $search = $namespacedModel::where(function ($query) use ($request) {
                foreach ($request->searchBy as $searchKey => $searchValue) {
                    $query->orWhere($searchKey, 'LIKE', '%' . $searchValue . '%');
                }
            });

            return $search->orderBy($this->sortBy, $this->sortDirection)->paginate(10);
        }

        return $namespacedModel::orderBy($this->sortBy, $this->sortDirection)->paginate(10);
    }
}
