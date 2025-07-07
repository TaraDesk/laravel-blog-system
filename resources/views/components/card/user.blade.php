<article class="py-6 px-4 flex items-center gap-6 bg-white rounded-lg">
    <!-- Profile Image -->
    <div class="w-24 h-24 rounded-full bg-gray-200 border border-gray-300 flex items-center justify-center">
        @if ($user->avatar)
        <img 
            src="/storage/{{ $user->avatar }}" 
            alt="{{ $user->name }} Image" 
            class="w-full h-full object-cover rounded-full"
        />
        @else
        <i class="fas fa-user text-gray-500 text-4xl"></i>
        @endif
    </div>

    <!-- Author Info -->
    <div class="flex flex-col justify-center ml-4 space-y-2">
        <!-- Name & Username -->
        <div>
            <h2 class="text-lg font-semibold text-gray-900 leading-tight hover:text-blue-300">
                <a href="{{ route('profile', ['username' => $user->username]) }}">{{ $user->name }}</a>
            </h2>
            <p class="text-gray-600 text-sm">{{ '@' . $user->username }}</p>
        </div>

        <!-- Joined At -->
        <p class="text-gray-500 text-sm flex items-center">
            <i class="fa-solid fa-calendar-days mr-2"></i>
            Joined: {{ $user->formatted_date }}
        </p>

        <!-- Post Count -->
        <p class="text-gray-500 text-sm flex items-center">
            <i class="fa-solid fa-book-open mr-2"></i>
            {{ count($user->posts) }} Stories Published
        </p>
    </div>
</article>
