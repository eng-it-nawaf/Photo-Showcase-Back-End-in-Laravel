<form method="POST" action="{{ isset($category->id) ? route('categories.update', $category->id) : route('categories.store') }}">
    @csrf
    @if(isset($category->id))
        @method('PUT')
    @endif

    <div>
        <label for="name">الاسم:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
    </div>
    
    <button type="submit">
        {{ isset($category->id) ? 'تحديث التصنيف' : 'إنشاء التصنيف' }}
    </button>
</form>
