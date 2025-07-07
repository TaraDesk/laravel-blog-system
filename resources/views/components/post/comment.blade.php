<section class="px-4 mx-auto mt-12 max-w-5xl border-t border-gray-100 py-8">
    <div class="mb-10">
        <h3 class="text-xl font-semibold text-gray-800 mb-6 text-center">Comments</h3>

        {{-- Comment Form --}}
        @auth
        <form action="{{ route('comment.store', ['username' => $post->author->username, 'slug' => $post->slug]) }}" method="POST" class="flex items-end space-x-2">
            @csrf
            <div class="flex-1">
                <label for="content" class="sr-only">Your Comment</label>
                <input name="content" id="content" required
                    placeholder="Write a comment..."
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200 text-sm resize-none"></textarea>
            </div>

            <button type="submit" title="Send"
                class="cursor-pointer px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
                <i class="fas fa-paper-plane"></i>
            </button>
        </form>
        @endauth

        {{-- Login CTA --}}
        @guest
        <div class="flex items-center justify-between bg-gray-100 text-gray-700 px-4 py-3 rounded-md">
            <p class="text-sm">You must be sign in to leave a comment.</p>
            <a href="{{ route('login') }}"
               class="ml-4 px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 transition text-sm font-medium">
                Sign In
            </a>
        </div>        
        @endguest
    </div>
    
    <div class="space-y-6">
        {{-- Comment --}}
        @foreach($post->comments as $comment)
        <div class="flex justify-between items-stretch space-x-4">
            <div class="flex space-x-4">
                <img src="{{ $comment->user->avatar ? '/storage/' . $comment->user->avatar : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}" 
                     alt="{{ $comment->user->name }}"
                     class="w-10 h-10 rounded-full">
        
                <div>
                    <p class="font-semibold text-gray-700">{{ $comment->user->name }}</p>
                    <p class="text-sm text-gray-500 mb-1">{{ $comment->created_at->diffForHumans() }}</p>
                    <p class="text-gray-800">{{ $comment->content }}</p>
                </div>
            </div>
            
            {{-- Edit & Delete Button --}}
            @auth
            <div class="flex gap-6 items-center ">
                @can('update', $comment)
                <button class="cursor-pointer group text-lg text-gray-500 hover:text-blue-600" 
                    title="Edit"
                    id="edit-comment"
                    data-comment-id="{{ $comment->id }}"
                    data-comment-body="{{ $comment->content }}"
                    data-route-comment="{{ '/@' . $post->author->username . '/' . $post->slug . '/' }}"
                >
                    <i class="fas fa-edit transition-colors duration-200"></i>
                </button>
                @endcan
                
                @can('delete', $comment)
                <form action="{{ route('comment.delete', ['username' => $post->author->username, 'slug' => $post->slug, 'comment' => $comment->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="cursor-pointer group text-lg text-gray-500 hover:text-red-600" title="Delete">
                        <i class="fas fa-trash-alt transition-colors duration-200"></i>
                    </button>
                </form>
                @endcan
            </div>
            @endauth
        </div>
        @endforeach
    </div>
</section>