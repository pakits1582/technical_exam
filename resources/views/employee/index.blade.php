<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employee List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('employees.create') }}" class="inline-block px-6 py-3 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Add New Employee
                    </a>
                    <div class="w-full">
                        <h1 class="text-2xl font-bold text-gray-700 mb-6 text-center">Employees</h1>
                        @if (session('message'))
                            <div class="border border-{{ session('alert-class') }}-400 {{ session('alert-class') }} px-4 py-3 rounded relative mb-4" role="alert">
                                <strong class="font-bold">{{ session('status') == 'success' ? 'Success!' : 'Error!' }}</strong>
                                <span class="block sm:inline">{{ session('message') }}</span>
                            </div>
                        @endif
                        <table class="table-auto w-full mb-3">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">First Name</th>
                                    <th class="px-4 py-2">Last Name</th>
                                    <th class="px-4 py-2">Email</th>
                                    <th class="px-4 py-2">Phone</th>
                                    <th class="px-4 py-2">Factory</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                <tr>
                                    <td class="border px-4 py-2">{{ $employee->first_name }}</td>
                                    <td class="border px-4 py-2">{{ $employee->last_name }}</td>
                                    <td class="border px-4 py-2">{{ $employee->email }}</td>
                                    <td class="border px-4 py-2">{{ $employee->phone }}</td>
                                    <td class="border px-4 py-2">{{ $employee->employee_factory->factory_name }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('employees.edit', $employee->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded focus:outline-none focus:shadow-outline">Edit</a>
                                        <form id="deleteForm_{{ $employee->id }}" class="inline-block" action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirmDelete({{ $employee->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        {{ $employees->links() }}
                        
                        <script>
                            function confirmDelete(factoryId) {
                                if (confirm("Are you sure you want to delete this employee?")) {
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
