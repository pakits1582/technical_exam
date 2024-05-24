<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Factory List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('factories.create') }}" class="inline-block px-6 py-3 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Add New Factory
                    </a>
                    <div class="w-full">
                        <h1 class="text-2xl font-bold text-gray-700 mb-6 text-center">Factories</h1>
                        @if (session('message'))
                            <div class="border border-{{ session('alert-class') }}-400 {{ session('alert-class') }} px-4 py-3 rounded relative mb-4" role="alert">
                                <strong class="font-bold">{{ session('status') == 'success' ? 'Success!' : 'Error!' }}</strong>
                                <span class="block sm:inline">{{ session('message') }}</span>
                            </div>
                        @endif
                        @foreach ($factories as $factory)
                            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                <p class="text-gray-700 font-bold">Factory Name: {{ $factory->factory_name }}</p>
                                <p class="text-gray-700">Location: {{ $factory->location }}</p>
                                <p class="text-gray-700">Email: {{ $factory->email }}</p>
                                <p class="text-gray-700">Website: {{ $factory->website }}</p>

                                <div class="mt-4 flex">
                                    <a href="{{ route('factories.edit', $factory->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</a>
                                    <form id="deleteForm_{{ $factory->id }}" action="{{ route('factories.destroy', $factory->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="return confirmDelete({{ $factory->id }})" class="ml-3 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                
                        {{ $factories->links() }} <!-- Pagination links -->

                        <script>
                            function confirmDelete(factoryId) {
                                if (confirm("Are you sure you want to delete this factory?")) {
                                    document.getElementById('deleteForm_' + factoryId).submit();
                                } else {
                                    return false;
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
