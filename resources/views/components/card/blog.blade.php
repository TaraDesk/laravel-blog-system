<article class="py-6 flex flex-wrap md:flex-nowrap rounded-lg gap-2 md:gap-6" data-category="{{ $post->category->name }}">
    {{-- Thumbnail --}}
    <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col items-center overflow-hidden">
        <div class="w-full h-60 md:h-48">
            <img src="{{ asset('storage/'. $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full rounded-md object-cover"/>
        </div>
    </div>
    
    {{-- Post Info --}}
    <div class="md:flex-grow flex flex-col justify-between">
        <div>
            {{-- Title --}}
            <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">
                <a href="{{ route('post.show', ['username' => $post->author->username, 'slug' => $post->slug]) }}" class="hover:text-indigo-600 transition">
                    {{ $post->title }}
                </a>
            </h2>
            
            {{-- Author & Time --}}
            <div class="text-sm text-gray-500 mb-4 flex flex-wrap items-center space-x-2">
                <span>
                    <i class="fa-solid fa-user mr-1"></i>
                    <a href="{{ route('profile', ['username' => $post->author->username]) }}" class="font-semibold text-gray-700 hover:text-indigo-600 transition">{{ $post->author->name }}</a>
                </span>
                <span>&bull;</span>
                <time datetime="2019-06-12" class="flex items-center">
                    <i class="fa-solid fa-calendar-days mr-1"></i> {{ $post->formatted_date }}
                </time>
            </div>
            
            {{-- Highlight --}}
            <p class="leading-relaxed mb-6">
                {{ $post->highlight }}
            </p>
        </div>
        
        {{-- Category & Tags --}}
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center space-x-6 flex-wrap">
                <span class="capitalize bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm flex items-center whitespace-nowrap">
                    <i class="fa-solid fa-folder mr-2"></i> {{ $post->category->name }}
                </span>
    
                <div class="flex flex-wrap gap-2 mt-1">
                    @foreach ($post->tags->take(4) as $tag)
                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs font-medium flex items-center whitespace-nowrap">
                            <i class="fa-solid fa-tag mr-1"></i> {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</article>