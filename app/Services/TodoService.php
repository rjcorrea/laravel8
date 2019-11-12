<?php

namespace App\Services;

use App\Todo;

class TodoService
{

    public $sortBy;
    public $sortDirection;

    public function __construct()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
    }

    public function all($request)
    {
        if ($request->sortBy) {
            $this->sortBy = $request->sortBy;
        }

        if ($request->sortDirection) {
            $this->sortDirection = $request->sortDirection;
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
