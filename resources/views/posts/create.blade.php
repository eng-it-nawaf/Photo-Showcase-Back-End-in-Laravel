<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- عرض الأخطاء إن وجدت -->
                    @if ($errors->any()) 
                        <div class="mb-4">
                            <div class="bg-red-500 text-white p-3 rounded">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif 

                    <!-- تعديل الـ form ليصبح قابلاً لرفع الملفات -->
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- حقل العنوان -->
                        <div class="mb-4">
                            <label for="title" class="block font-medium text-gray-700">Title:</label>
                            <input type="text" name="title" id="title" 
                                value="{{ old('title') }}"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>

                        <!-- حقل النص -->
                        <div class="mb-4">
                            <label for="text" class="block font-medium text-gray-700">Text:</label>
                            <textarea name="text" id="text" rows="5" 
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('text') }}</textarea>
                        </div>

                        <!-- حقل الفئة -->
                        <div class="mb-4">
                            <label for="category_id" class="block font-medium text-gray-700">Category:</label>
                            <select name="category_id" id="category_id" 
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- حقل الصورة -->
                        <div class="mb-4">
                            <label for="image" class="block font-medium text-gray-700">Image:</label>
                            <input type="file" name="image" id="image" 
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>

                        <!-- زر الحفظ -->
                        <div>
                            <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
