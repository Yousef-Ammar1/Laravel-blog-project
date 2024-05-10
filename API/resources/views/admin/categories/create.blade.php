<x-layout>
    <x-setting heading="Publish New Book">
        <form method="POST" action="/admin/categories" enctype="multipart/form-data">
            @csrf
            <x-form.input name="name" />
            <x-form.input name="description" />
            <x-form.button>Add</x-form.button>
        </form>
    </x-setting>
</x-layout>
