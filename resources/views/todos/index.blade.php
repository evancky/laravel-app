<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('TODO List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <a href="{{ route('todos.create') }}" class="btn btn-primary">Create TODO</a>
            @foreach ($todos as $todo)
                <div class="bg-white shadow sm:rounded-lg p-6">
                    <h3>{{ $todo->title }}</h3>
                    <p>{{ $todo->description }}</p>
                    <p>Status: {{ $todo->status }}</p>
                    <p>Privacy: {{ $todo->privacy }}</p>
                    @if ($todo->image)
                        <img src="{{ asset('storage/' . $todo->image) }}" alt="TODO Image" class="w-32 h-32">
                    @endif
                    <div class="mt-4">
                        <a href="{{ route('todos.edit', $todo) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
