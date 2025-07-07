@props(['category'])

<button 
    class="cursor-pointer flex-shrink-0 px-4 py-2 rounded-full text-sm font-semibold text-gray-700 hover:bg-indigo-100 hover:text-indigo-600 whitespace-nowrap capitalize"
    id="menu-{{ $category }}" data-menu="{{ $category }}">
    {{ $category }}
</button>