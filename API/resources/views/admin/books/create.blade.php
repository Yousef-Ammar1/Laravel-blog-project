<x-layout>
    <x-setting heading="Publish New Book">
        <form method="POST" action="/admin/books" enctype="multipart/form-data">
            @csrf
            <x-form.input name="title" />
            <x-form.input name="author" />
            <x-form.input name="isbn" />
            <x-form.textarea name="description" />
                <x-form.label name="subcategory" />
                <select name="subcategory_id" id="subcategory_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach (\App\Models\Subcategory::all() as $subcategory)
                    <option value="{{ $subcategory->id }}"
                        {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                        {{ ucwords($subcategory->name) }}</option>
                        @endforeach
                    </select>
                    <x-form.error name="subcategory" />
                </x-form.label" >
                <x-form.button>Publish</x-form.button>
        </form>
    </x-setting>
</x-layout>
