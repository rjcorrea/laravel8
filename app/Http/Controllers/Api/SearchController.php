<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SearchService;

class SearchController extends Controller
{
    private $searchService;

    public function __construct(SearchService $service)
    {
        $this->searchService = $service;
    }

    public function search(Request $request, $model)
    {
        return $this->searchService->search($request, $model);
    }
}
