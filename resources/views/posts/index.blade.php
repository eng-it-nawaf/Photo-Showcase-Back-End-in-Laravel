<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- عرض رسالة نجاح إن وجدت -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">{{ session('success') }}</strong>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full bg-white border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="py-2 px-4 border-b">Title</th>
                                    <th class="py-2 px-4 border-b">Category</th>
                                    <th class="py-2 px-4 border-b">Image</th> <!-- عمود الصورة -->
                                    <th class="py-2 px-4 border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td class="py-2 px-4 border-b text-center">{{ $post->title }}</td>
                                        <td class="py-2 px-4 border-b text-center">{{ $post->category->name }}</td>
                                        
                                        <!-- عرض الصورة إذا كانت موجودة -->
                                        <td class="py-2 px-4 border-b text-center">
                                            @if($post->image)
                                                <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" width="100">
                                            @else
                                                <span>لا توجد صورة</span>
                                            @endif
                                        </td>

                                        <td class="py-2 px-4 border-b text-center">
                                            <div class="flex justify-center items-center space-x-2">
                                                <a href="{{ route('posts.edit', $post) }}" 
                                                   class="text-green-600 hover:text-green-500 bg-gray-100 rounded py-1 px-2">Edit</a>

                                                <form method="POST" action="{{ route('posts.destroy', $post) }}" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                        class="text-red-600 hover:text-red-500 bg-gray-100 rounded py-1 px-2" onclick="return confirm('هل أنت متأكد؟')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- الزر تحت الجدول -->
                    <div class="mt-4 text-right">
                        <a href="{{ route('posts.create') }}" 
                        class="bg-green-500 text-white py-2 px-2 rounded hover:bg-green-600"
                        style="background-color: #044657; width: 120px; text-align: center;">
                            Add New Post
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
