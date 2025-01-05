<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- عرض رسالة نجاح إن وجدت -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">{{ session('success') }}</strong>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full bg-white border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600">
                                    <th class="py-2 px-4 border-b text-center">Name</th>
                                    <th class="py-2 px-4 border-b text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr class="hover:bg-gray-100">
                                        <td class="py-2 px-4 border-b text-center">{{ $category->name }}</td>
                                        <td class="py-2 px-4 border-b text-center">
                                            <div class="flex justify-center items-center space-x-2">
                                                <a href="{{ route('categories.edit', $category) }}" class="text-green-600 hover:text-green-500 bg-gray-100 rounded py-1 px-2 transition duration-150 ease-in-out">Edit</a>
                                                <form method="POST" action="{{ route('categories.destroy', $category) }}" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-500 bg-gray-100 rounded py-1 px-2 transition duration-150 ease-in-out" onclick="return confirm('هل أنت متأكد؟')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('categories.create') }}"
                        class="bg-green-500 text-white py-2 px-2 rounded hover:bg-green-600"
                        style="background-color: #044657; width: 80px; text-align: center;">
                            Add New Category
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
