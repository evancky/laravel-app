<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TodoApiController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return response()->json(['todos' => $todos]);
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

        return response()->json($todo, 201);
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
                Storage::disk('public')->delete($todo->image);
                $todo->image = null;
            }
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            if ($todo->image) {
                Storage::disk('public')->delete($todo->image);
            }
            $todo->image = $request->file('image')->store('todo-images', 'public');
        }

        $todo->update($request->only('title', 'description', 'status', 'privacy'));

        return response()->json($todo, 200);
    }

    public function destroy(Todo $todo)
    {
        if ($todo->image && Storage::disk('public')->exists($todo->image)) {
            Storage::disk('public')->delete($todo->image);
        }

        $todo->delete();

        return response()->json(['message' => 'TODO item deleted successfully.'], 200);
    }
}
