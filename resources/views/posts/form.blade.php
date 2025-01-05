<form method="POST" action="{{ isset($post->id) ? route('posts.update', $post->id) : route('posts.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($post->id))
        @method('PUT')
    @endif

    <!-- حقل العنوان -->
    <div class="mb-4">
        <label for="title" class="block font-medium text-gray-700">العنوان:</label>
        <input type="text" name="title" id="title" 
            value="{{ old('title', $post->title ?? '') }}" 
            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
    </div>

    <!-- حقل رفع الصورة -->
    <div class="mb-4">
        <label for="image" class="block font-medium text-gray-700">الصورة:</label>
        <input type="file" name="image" id="image"
            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
    </div>

    <!-- إذا كانت الصورة موجودة، عرضها -->
    @if(isset($post->image))
        <div class="mb-4">
            <label class="block font-medium text-gray-700">الصورة الحالية:</label>
            <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" width="150">
        </div>
    @endif

    <!-- زر الإرسال -->
    <button type="submit">
        {{ isset($post->id) ? 'تحديث التصنيف' : 'إنشاء التصنيف' }}
    </button>
</form>
