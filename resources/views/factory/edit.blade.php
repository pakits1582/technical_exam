<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Factory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('factories.index') }}" class="inline-block px-6 py-3 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Factory List
                    </a>
                </div>
                <div class="w-full p-4">
                    <h1 class="text-2xl font-bold text-gray-700 mb-6">Edit Factory</h1>
                    @if (session('message'))
                        <div class="border border-{{ session('alert-class') }}-400 {{ session('alert-class') }} px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">{{ session('status') == 'success' ? 'Success!' : 'Error!' }}</strong>
                            <span class="block sm:inline">{{ session('message') }}</span>
                        </div>
                    @endif
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{ route('factories.update', $factory->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- This indicates it's an update request -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="factory_name">
                                Factory Name
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="factory_name" name="factory_name" type="text" placeholder="Factory Name" value="{{ $factory->factory_name }}">
                            @error('factory_name')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="location">
                                Location
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="location" name="location" type="text" placeholder="Location" value="{{ $factory->location }}">
                            @error('location')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                Email
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="email@email.com" value="{{ $factory->email }}">
                            @error('email')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="website">
                                Website
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="website" name="website" type="url" placeholder="https://website.com" value="{{ $factory->website }}">
                            @error('website')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                Update Factory
                            </button>
                        </div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</x-app-layout>
