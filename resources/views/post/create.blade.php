<x-app.layout>
    <x-slot:title>
        Create Post | StoryHub
    </x-slot:title>

    <x-app.navbar />

    <section class="min-h-screen py-10 px-4">
        <div class="container mx-auto bg-white rounded-md shadow-xl px-8 py-4 overflow-hidden">
            {{-- Header --}}
            <div class="flex items-center gap-3 mb-8">
                <i class="fas fa-pen-nib text-blue-600 text-xl"></i>
                <h2 class="text-2xl font-semibold text-gray-800">Create New Post</h2>
            </div>
    
            {{-- Form --}}
            <form action="{{ route('create.store')}}" method="POST" enctype="multipart/form-data" id="quill">
                @csrf
                
                {{-- Thumbnail --}}
                <div class="mb-10">
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Thumbnail</label>
                    <label for="thumbnail"
                        class="flex flex-col items-center justify-center w-full h-56 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 transition"
                        id="thumbnail-label">
                        <div class="text-center text-gray-500" id="thumbnail-placeholder">
                            <i class="fas fa-image text-3xl mb-2"></i>
                            <p>Click to upload thumbnail</p>
                        </div>
                        <img id="thumbnail-preview" class="hidden object-contain h-full" alt="Thumbnail Preview">
                        <input type="file" name="thumbnail" id="thumbnail" class="hidden" accept="image/*">
                    </label>
                </div>
    
                <div class="flex flex-col gap-6">
                    <div class="md:flex md:gap-6">
                        {{-- Title --}}
                        <div class="w-full space-y-2">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                                value="{{ old('title') }}">
                        </div>
                        
                        {{-- Category --}}
                        <div class="w-full space-y-2 mt-6 md:mt-0">
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category" id="category"
                                class="w-full capitalize border border-gray-300 rounded-lg px-4 py-2 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    {{-- Highlight --}}
                    <div class="space-y-2">
                        <label for="highlight" class="block text-sm font-medium text-gray-700">Highlight</label>
                        <textarea name="highlight" id="highlight" rows="4"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">{{ old('highlight') }}</textarea>
                    </div>
                    
                    {{-- Tags --}}
                    <div class="space-y-2">
                        <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                        <input type="text" name="tags" id="tags"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            value="{{ old('tags') }}">
                    </div>
                    
                    {{-- Content --}}
                    <div class="space-y-2">
                        <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                        <div id="editor-container"
                            class="min-h-[200px] rounded-lg border border-gray-300 p-3 bg-white overflow-auto shadow-sm focus-within:ring-2 focus-within:ring-blue-500 transition">{{ old('content') }}
                        </div>
                        <input type="hidden" name="content" id="content">
                    </div>
                </div>
    
                {{-- Buttons --}}
                <div class="flex justify-end gap-4 my-8">
                    <a href="{{ route('home') }}"
                       class="px-5 py-2 text-sm font-medium text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-lg transition">Cancel</a>
                    <x-form.button>Create</x-form.button>
                </div>
            </form>
        </div>
    </section>
    
    <x-app.footer />

    @if ($errors->any())
        <x-alerts.error :error="$errors->all()" />
    @endif
</x-app.layout>