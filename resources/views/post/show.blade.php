<x-app.layout>
    <x-slot:title>
        {{ $post->title }} | StoryHub
    </x-slot:title>

    <x-app.navbar />

    <section class="px-4 mx-auto mt-8 mb-4 max-w-5xl">
        {{-- Thumbnail --}}
        <div class="overflow-hidden rounded-lg shadow-md mb-6">
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Post Thumbnail" class="w-full h-82 object-cover">
        </div>
    
        {{-- Title --}}
        <h2 class="text-3xl font-bold text-gray-800 leading-tight mb-2">
            {{ $post->title }}
        </h2>
    
        {{-- Category --}}
        <div class="mb-6">
            <span class="capitalize inline-block px-3 py-1 text-sm font-medium text-gray-700 bg-gray-200 rounded-full">
                {{ $post->category->name }}
            </span>
        </div>
    
        {{-- Author & Menus --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between text-sm text-gray-500 mb-6">
            <div class="flex items-center mb-3 sm:mb-0">
                <img src={{ $post->author->avatar ? '/storage/' . $post->author->avatar : 'https://ui-avatars.com/api/?name=' . urlencode($post->author->name) }}
                     alt="{{ $post->author->name ?? 'Author' }}" 
                     class="w-10 h-10 rounded-full mr-3">
                <div>
                    <p class="font-semibold text-gray-700">{{ $post->author->name }}</p>
                    <p>{{ $post->created_at->format('F j, Y') }}</p>
                </div>
            </div>
               
            <x-post.menu :post="$post" />
        </div>
    
        {{-- Content --}}
        <div id="post-content" class="prose prose-lg max-w-none">
            {!! $post->content !!}
        </div>
    
        {{-- Tags --}}
        <div class="mt-8">
            <h4 class="text-sm font-semibold text-gray-600 mb-2">Tags:</h4>
            <div class="flex flex-wrap gap-2">
                @foreach($post->tags as $tag)
                    <span class="inline-block bg-gray-200 text-gray-700 text-xs px-3 py-1 rounded-full">
                        #{{ $tag->name }}
                    </span>
                @endforeach
            </div>
        </div>
    </section>
           
    {{-- Comments --}}
    <x-post.comment :post="$post" />

    <x-app.footer />

    {{-- Comment Modal --}}
    <div id="editModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        <div id="editModalContent" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-xl">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Edit Comment</h2>
            </div>
    
            <form id="editCommentForm" method="POST">
                @csrf
                @method('PATCH')
            
                <div class="mb-4">
                    <label for="modalCommentBody" class="block text-sm font-medium text-gray-700 mb-1">
                        Comment
                    </label>
                    
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <i class="fas fa-comment-alt"></i>
                        </span>
                        <input type="text" name="content" id="modalCommentBody"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded focus:ring focus:ring-blue-200 focus:outline-none"
                            placeholder="Edit your comment..."
                        />
                    </div>
                </div>
            
                <div class="flex justify-end space-x-2">
                    <button type="button" id="cancelModalBtn" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded">
                        <i class="fas fa-save mr-1"></i> Save
                    </button>
                </div>
            </form>
            
        </div>
    </div>
    
    @if ($errors->any())
        <x-alerts.error :error="$errors->all()" />
    @endif
</x-app.layout>