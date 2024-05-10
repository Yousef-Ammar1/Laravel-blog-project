<x-layout>
    <x-setting heading="Publish New Book">
        <form method="POST" action="/admin/subcategories" enctype="multipart/form-data">
            @csrf
            <x-form.input name="name" />

            <x-form.field>
                <x-form.label name="category" />
                <select name="category_id" id="category_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ ucwords($category->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="category" />
            </x-form.field>
            <x-form.button>Publish</x-form.button>
        </form>
    </x-setting>
</x-layout>
