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

        if($request->searchBy){
            $search = $namespacedModel::orWhere(function($query) use ($request) {
                foreach ($request->searchBy as $searchKey => $searchValue) {
                    $query->orWhere($searchKey, 'LIKE', '%'.$searchValue.'%');
                }
            });
        }

        if ($request->sortBy && $request->sortDirection) {
            $this->sortBy = $request->sortBy;
            $this->sortDirection = $request->sortDirection;
        }

        $search->orderBy($this->sortBy, $this->sortDirection);

        return $search->paginate(10);
    }
}
