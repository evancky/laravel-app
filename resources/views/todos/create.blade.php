<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create TODO') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('todos.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" class="mt-1 block w-full"></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="mt-1 block w-full">
                            <option value="COMPLETED">COMPLETED</option>
                            <option value="KIV">KIV</option>
                            <option value="ABANDONED">ABANDONED</option>
                            <option value="IN-PROGRESS">IN-PROGRESS</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>

                    <div>
                        <x-input-label for="privacy" :value="__('Privacy')" />
                        <select id="privacy" name="privacy" class="mt-1 block w-full">
                            <option value="PUBLIC">PUBLIC</option>
                            <option value="USERS">USERS</option>
                            <option value="SELF">SELF</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('privacy')" />
                    </div>

                    <div>
                        <x-input-label for="image" :value="__('Image')" />
                        <input id="image" type="file" class="mt-1 block w-full" name="image" accept="image/*" />
                        <x-input-error class="mt-2" :messages="$errors->get('image')" />
                    </div>

                    <div class="mt-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
