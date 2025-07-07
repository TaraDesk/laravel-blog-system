<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold gradient-text">StoryHub</a>
            </div>

            <!-- Search -->
            <div class="flex-1 max-w-md mx-4 hidden md:block">
                <form class="relative" method="GET" action="{{ route('search') }}">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input name="q" type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-full bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Search">
                    <button type="submit" class="hidden"></button>
                </form>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                {{-- Login/Register --}}
                @guest
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">
                    Sign In
                </a>
                <a href="{{ route('register') }}" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium">
                    Sign Up
                </a>
                @endguest

                {{-- Links --}}
                @auth
                <a href="{{ route('create') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">
                    <i class="fa-solid fa-pen inline-block w-4 h-4 mr-1"></i>
                </a>
                                  
                <div class="relative">
                    <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                        <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center">
                            @if (Auth::user()->avatar)
                                <img src="/storage/{{ Auth::user()->avatar }}" alt="Your Profile Image" 
                                    class="w-full h-full object-cover rounded-full"/>
                            @else
                                <i class="fas fa-user text-indigo-600 text-sm"></i>
                            @endif
                        </div>
                        <span class="hidden md:inline-block text-sm font-medium text-gray-700">
                            {{ Auth::user()->name }}
                        </span>
                        <i class="fas fa-chevron-down hidden md:inline-block text-gray-500 text-sm"></i>
                    </button>                        
                    
                    <!-- Dropdown menu -->
                    <div id="user-menu" class="hidden absolute right-0 mt-4 w-48 bg-white rounded-md shadow-lg py-1 z-10 border border-gray-200">
                        <a href="{{ route('profile', ['username' => Auth::user()->username]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fa-solid fa-user inline-block w-4 h-4 mr-2"></i>
                            Profile
                        </a>
                          
                        <a href="{{ route('library') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fa-solid fa-heart inline-block w-4 h-4 mr-2"></i>
                            Liked
                        </a>
                      
                        <form action="{{ route('logout') }}" method="post" class="px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            @csrf
                            <button type="submit" class="cursor-pointer block w-full text-start">
                                <i class="fa-solid fa-right-from-bracket inline-block w-4 h-4 mr-2"></i>
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>

            {{-- Mobile Menu Button --}}
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-900 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden absolute top-16 left-0 w-full bg-white border-t border-gray-200 shadow-lg z-40">
        <div class="px-4 pt-4 pb-6 space-y-2">
            <form class="relative" method="GET" action="{{ route('search') }}">
                <input type="text" class="block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 mb-2" placeholder="Search">
                <button type="submit" class="hidden"></button>
            </form>

            @guest
            <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">Sign In</a>
            <a href="{{ route('register') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">Sign Up</a>    
            @endguest
            
            @auth
            <a href="{{ route('create') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">Write</a>
            <a href="{{ route('profile', ['username' => Auth::user()->username]) }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">Profile</a>
            <a href="{{ route('library') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">Liked</a>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="block px-3 py-2 text-base font-medium text-red-300 hover:bg-red-100 hover:text-red-600 rounded-md">
                    Sign out
                </button>
            </form>
            @endauth
        </div>
    </div>
</nav>