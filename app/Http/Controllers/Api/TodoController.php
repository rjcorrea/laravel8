<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use App\Todo;

class TodoController extends Controller
{
    private $sortBy;
    private $sortDirection;

    public function __construct()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('sortBy') && $request->has('sortDirection')){
            $this->sortBy = $request->sortBy;
            $this->sortDirection = $request->sortDirection;
        }
        
        $todos = Todo::orderBy($this->sortBy, $this->sortDirection);

        return $todos->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
        $validatedData = $request->validated();

        $todo = Todo::create($validatedData);
        return response($todo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::findOrFail($id);
        return $todo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodoRequest $request, $id)
    {
        $validatedData = $request->validated();

        $todo = Todo::findOrFail($id);
        $todo->update($validatedData);

        return $todo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $isDeleted = $todo->delete();
        if ($isDeleted) {
            return response()->json(['status' => 'success'], 200);
        } else {
            return response()->json(['status' => 'error'], 400);
        }
    }

    public function search(Request $request){

        if($request->has('name')){
            $todos = Todo::where('name', 'LIKE', "{$request->name}%");
        }

        if($request->has('sortBy') && $request->has('sortDirection')){
            $this->sortBy = $request->sortBy;
            $this->sortDirection = $request->sortDirection;
        }
        
        $todos->orderBy($this->sortBy, $this->sortDirection);

        return $todos->paginate(10);
    }
}
