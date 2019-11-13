<?php

namespace App\Services;

use App\Todo;

class TodoService
{

    private $sortBy = 'id';
    private $sortDirection = 'desc';

    public function all()
    {
        if (request()->has('sortBy')) {
            $this->sortBy = request()->sortBy;
        }

        if (request()->has('sortDirection')) {
            $this->sortDirection = request()->sortDirection;
        }

        $todos = Todo::orderBy($this->sortBy, $this->sortDirection);

        return $todos->paginate(10);
    }

    public function show($id)
    {
        return Todo::findOrFail($id);
    }

    public function store($request)
    {
        $data = $request->validated();
        return Todo::create($data);
    }

    public function update($request, $id)
    {
        $data = $request->validated();
        $todo = Todo::findOrFail($id);
        return tap($todo)->update($data);
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        return $todo->delete();
    }
}
