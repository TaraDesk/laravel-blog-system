<x-app.layout>
    <x-slot:title>
        {{ $user->name }} | StoryHub
    </x-slot:title>

    <x-app.navbar />

    <section class="container px-8 mx-auto mt-8 mb-4">
        <div class="flex items-start gap-6">
            {{-- Avatar --}}
            <div class="flex-shrink-0">
                @if ($user->avatar)
                <div class="w-24 h-24 rounded-full bg-gray-200 border border-gray-300 overflow-hidden">
                    <img src="/storage/{{ $user->avatar }}" alt="{{ $user->name }} Photo" class="w-full h-full object-cover">
                </div>
                @else
                <div class="w-24 h-24 rounded-full bg-gray-200 border border-gray-300 flex items-center justify-center">
                    <i class="fas fa-user text-gray-500 text-4xl"></i>
                </div>
                @endif
            </div>
            
            {{-- Author Info --}}
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
                        <p class="text-gray-600 text-sm">{{ '@' . $user->username }}</p>
                    </div>
                    
                    {{-- Buttons --}}
                    @can('update', $user)
                    <div class="flex gap-2">
                        <a href="{{ route('profile.edit', ['username' => $user->username]) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-700 rounded-md hover:bg-gray-800 transition-colors">
                            <i class="fas fa-edit mr-2"></i>Edit Profile
                        </a>

                        <form action="{{ route('profile.delete', ['username' => $user->username]) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="cursor-pointer inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 transition-colors">
                                <i class="fas fa-trash-alt mr-2"></i>
                                Delete Account
                            </button>
                        </form>
                    </div>
                    @endcan
                </div>
                
                {{-- Bio --}}
                <p class="mt-3 text-gray-700">
                @if ($user->bio)
                    {{ $user->bio }}
                @else
                    A curious mind with a passion for thoughtful writing and meaningful conversations.
                @endif
                </p>
    
                <div class="flex mt-4 space-x-6 text-gray-700 text-sm">
                    <span><strong>{{ count($posts) }}</strong> Posts</span>
                </div>
                
                {{-- Social Links --}}
                <div class="mt-4 flex space-x-4 text-gray-500">
                    @foreach ($socials as $platform => $icon)
                        @php
                        $link = $user->social_media[$platform] ?? null;
                        @endphp
            
                        @if ($link)
                        <a href="{{ $link }}" class="hover:text-gray-800" aria-label="{{ ucfirst($platform) }}" target="_blank" rel="noopener noreferrer">
                            <i class="{{ $icon }}"></i>
                        </a>
                        @else
                        <a href="/" class="text-gray-300 cursor-not-allowed pointer-events-none" 
                            aria-label="{{ ucfirst($platform) }}" aria-disabled="true">
                            <i class="{{ $icon }}"></i>
                        </a>
                        @endif
                    @endforeach
                </div>       
            </div>
        </div>
    
        <hr class="my-6 border-t border-gray-200">

        @if (count($posts) == 0)
            <div class="text-center text-gray-500 mt-12">
                There are no posts to show right now.
            </div>  
        @else
            @foreach ($posts as $post)
                <x-card.blog :post="$post" />
            @endforeach
        @endif
    </section>

    <x-app.footer />

    @if (session('success'))
        <x-alerts.success :flash="session('success')" />
    @endif
</x-app.layout>