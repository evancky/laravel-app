<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Todo Audit Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">Event</th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">User</th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">Old Values</th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">New Values</th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($audits as $audit)
                                <tr>
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $audit->event }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $audit->user->name ?? 'System' }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">{{ json_encode($audit->old_values) }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">{{ json_encode($audit->new_values) }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $audit->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
