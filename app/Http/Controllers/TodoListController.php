<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use App\Http\Resources\TodoListResource;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{
    public function index()
    {
        $lists = auth()->user()->todos;
        return TodoListResource::collection($lists);
    }

    public function show(TodoList $todos)
    {
        return new TodoListResource($todos);
    }

    public function store(TodoListRequest $request)
    {
        $todos = auth()->user()
            ->todos()
            ->create($request->validated());

        return new TodoListResource($todos);
    }

    public function destroy(TodoList $todos)
    {
        $todos->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }

    public function update(TodoListRequest $request, TodoList $todos)
    {
        $todos->update($request->all());
        return new TodoListResource($todos);
    }
}