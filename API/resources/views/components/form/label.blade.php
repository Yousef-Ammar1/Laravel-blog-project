@props(['name'])
<label class="block mb-2 mt-6 uppercase font-bold text-xs text-gray-700" for="{{ $name }}">
    {{ ucwords($name) }}
</label>
