<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SearchService;

class SearchController extends Controller
{
    private $searchService;

    public function __construct(SearchService $service)
    {
        $this->searchService = $service;
    }

    public function search($model)
    {
        return $this->searchService->search($model);
    }
}
