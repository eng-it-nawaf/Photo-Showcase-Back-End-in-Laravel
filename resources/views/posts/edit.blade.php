<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- تعديل الـ form ليصبح قابلاً لرفع الملفات -->
                    <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block font-medium text-gray-700">Title:</label>
                            <input type="text" name="title" id="title" value="{{ $post->title }}"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>

                        <div class="mb-4">
                            <label for="text" class="block font-medium text-gray-700">Text:</label>
                            <textarea name="text" id="text" rows="5"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $post->text }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="block font-medium text-gray-700">Category:</label>
                            <select name="category_id" id="category_id"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($category->id == $post->category_id)>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- عرض الصورة الحالية إذا كانت موجودة -->
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700">Current Image:</label>
                            @if ($post->image)
                                <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" width="150">
                            @else
                                <p>No image available</p>
                            @endif
                        </div>

                        <!-- حقل رفع الصورة الجديدة -->
                        <div class="mb-4">
                            <label for="image" class="block font-medium text-gray-700">Change Image:</label>
                            <input type="file" name="image" id="image"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>

                        <button type="submit" 
                            style="background-color: #1E3A8A;" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
