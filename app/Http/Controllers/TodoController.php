<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'privacy' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $todo = new Todo($request->all());

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('todo-images', 'public');
            $todo->image = $path;
        }

        $todo->save();

        return redirect()->route('todos.index')->with('success', 'TODO item created successfully.');
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'privacy' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'remove_image' => 'nullable|boolean',
        ]);

        // Check if the image should be removed
        if ($request->has('remove_image') && $request->remove_image) {
            if ($todo->image) {
                \Storage::disk('public')->delete($todo->image);
                $todo->image = null;
            }
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            if ($todo->image) {
                \Storage::disk('public')->delete($todo->image);
            }
            $todo->image = $request->file('image')->store('todo-images', 'public');
        }

        $todo->update($request->only('title', 'description', 'status', 'privacy'));

        return redirect()->route('todos.index')->with('status', 'Todo updated successfully!');
    }


    public function destroy(Todo $todo)
    {
        if ($todo->image && Storage::disk('public')->exists($todo->image)) {
            Storage::disk('public')->delete($todo->image);
        }

        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'TODO item deleted successfully.');
    }

    public function audit()
    {
        $audits = Auth::user()->audits;
        return view('todos.audit', compact('audits'));
    }
}
