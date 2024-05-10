<x-layout>
    <x-setting :heading="'Edit Book:' . $book->title">
        <form method="POST" action="/admin/books/{{ $book->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.field>
                <x-form.label name="Author" />

                <select name="user_id" id="user_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach (\App\Models\Book::all() as $user)
                        <option value="{{ $user->id }}"
                            {{ old('id', $user->user_id) == $user->id ? 'selected' : '' }}>
                            {{ ucwords($user->name) }}</option>
                    @endforeach
                </select>

                <x-form.error name="user_id" />
            </x-form.field>

            <x-form.input name="title" value="{{ $book->title }}" />


            <x-form.input name="description" value="{{ $book->description }}" />
            <x-form.input name="isbn" value="{{ $book->isbn }}" />
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
            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>
