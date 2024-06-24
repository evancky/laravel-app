<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit TODO') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('todos.update', $todo) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $todo->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" class="block mt-1 w-full" name="description" rows="4">{{ old('description', $todo->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="block mt-1 w-full">
                                <option value="COMPLETED" {{ old('status', $todo->status) == 'COMPLETED' ? 'selected' : '' }}>COMPLETED</option>
                                <option value="KIV" {{ old('status', $todo->status) == 'KIV' ? 'selected' : '' }}>KIV</option>
                                <option value="ABANDONED" {{ old('status', $todo->status) == 'ABANDONED' ? 'selected' : '' }}>ABANDONED</option>
                                <option value="IN-PROGRESS" {{ old('status', $todo->status) == 'IN-PROGRESS' ? 'selected' : '' }}>IN-PROGRESS</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Privacy -->
                        <div class="mt-4">
                            <x-input-label for="privacy" :value="__('Privacy')" />
                            <select id="privacy" name="privacy" class="block mt-1 w-full">
                                <option value="PUBLIC" {{ old('privacy', $todo->privacy) == 'PUBLIC' ? 'selected' : '' }}>PUBLIC</option>
                                <option value="USERS" {{ old('privacy', $todo->privacy) == 'USERS' ? 'selected' : '' }}>USERS</option>
                                <option value="SELF" {{ old('privacy', $todo->privacy) == 'SELF' ? 'selected' : '' }}>SELF</option>
                            </select>
                            <x-input-error :messages="$errors->get('privacy')" class="mt-2" />
                        </div>

                        <!-- Image -->
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Image')" />
                            <input id="image" type="file" name="image" class="block mt-1 w-full" accept="image/*" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        @if ($todo->image)
                            <div class="mt-4">
                                <img src="{{ asset('storage/' . $todo->image) }}" alt="Current Image" class="w-32 h-32 object-cover">
                                <label for="remove_image" class="inline-flex items-center mt-2">
                                    <input type="checkbox" id="remove_image" name="remove_image" value="1">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remove Image') }}</span>
                                </label>
                            </div>
                        @endif

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
