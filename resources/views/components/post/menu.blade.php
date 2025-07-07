<div class="flex items-center text-sm text-gray-500 gap-12">
    <div class="flex items-center space-x-4">
        {{-- View Count --}}
        <div class="flex items-center text-gray-600">
            <i class="fas fa-eye mr-1"></i>
            <span>{{ number_format($post->view) }} views</span>
        </div>

        {{-- Liked Button --}}
        @auth
        <form action="{{ route('like', ['username' => $post->author->username, 'slug' => $post->slug]) }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center text-gray-600 hover:text-red-600">
                <i class="fas fa-heart mr-1 {{ Auth::user()->hasLiked($post->id) ? 'text-red-600' : '' }}"></i> Like
            </button>            
        </form>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="flex items-center text-gray-600 hover:text-red-600">
                <i class="fas fa-heart mr-1"></i> Like
            </a>
        @endguest
        
        {{-- Share Button --}}
        <div class="relative">
            <button id="shareToggle" class="flex items-center text-gray-600 hover:text-gray-800 focus:outline-none">
                <i class="fas fa-share-alt mr-1"></i> Share
                <i class="fas fa-caret-down ml-1"></i>
            </button>
            <div id="shareMenu" class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-md hidden z-10">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" 
                   target="_blank" 
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fab fa-facebook mr-2 text-blue-600"></i> Facebook
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::url()) }}&text={{ urlencode($post->title) }}" 
                   target="_blank" 
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fab fa-twitter mr-2 text-blue-400"></i> Twitter
                </a>
                <a href="https://t.me/share/url?url={{ urlencode(Request::url()) }}&text={{ urlencode($post->title) }}" 
                   target="_blank" 
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fab fa-telegram mr-2 text-blue-500"></i> Telegram
                </a>
            </div>
        </div>
    </div>

    {{-- Edit & Delete Button --}}
    @can('update', $post)
    <div class="ml-auto sm:ml-0 flex items-center space-x-4">
        <a href="{{ route('post.edit', ['username' => $post->author->username, 'slug' => $post->slug]) }}" class="text-gray-600 hover:text-gray-800 flex items-center">
            <i class="fas fa-edit mr-1"></i> Edit
        </a>
        
        <form action="{{ route('post.delete', ['username' => $post->author->username, 'slug' => $post->slug]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="cursor-pointer text-red-600 hover:text-red-800 flex items-center">
                <i class="fas fa-trash-alt mr-1"></i> Delete
            </button>
        </form>
    </div>
    @endcan
</div>