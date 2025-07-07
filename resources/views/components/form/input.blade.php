@props(['name', 'title', 'icon', 'type'])

<div class="w-full flex flex-col gap-1 mb-4">
    <label class="font-semibold text-xs text-gray-500">{{ $title }}</label>
    <div class="relative">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
            <i class="fas {{ $icon }}"></i>
        </span>
        <input name="{{ $name }}" value="{{ old($name) }}" type="{{ $type }}"
            class="pl-10 border border-gray-300 rounded-lg p-3 text-sm w-full outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Enter your {{ $title }}" />
    </div>
</div>