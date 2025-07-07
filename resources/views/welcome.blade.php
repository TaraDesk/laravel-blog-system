<x-app.layout>
    <x-slot:title>
        StoryHub - Where good ideas find you
    </x-slot:title>

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-900">StoryHub</a>
                </div>
    
                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Our Story</a>
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Write</a>
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">Sign In</a>
                    <a href="{{ route('register') }}" class="bg-black hover:bg-gray-800 text-white px-4 py-2 rounded-full text-sm font-medium transition-colors">Get Started</a>
                </div>
    
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-900 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    
        <!-- Mobile menu (absolute) -->
        <div id="mobile-menu" class="hidden md:hidden absolute top-16 left-0 w-full bg-white border-t border-gray-200 shadow-lg z-40">
            <div class="px-4 pt-4 pb-6 space-y-4">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">Our Story</a>
                <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">Write</a>
                <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:bg-gray-100 rounded-md">Sign In</a>
                <a href="{{ route('register') }}" class="inline-block px-3 py-2 text-base font-medium text-white bg-black rounded-md">Get Started</a>
            </div>
        </div>
    </nav>    
    
    <!-- Hero Section -->
    <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 pt-8 md:flex-row flex-col items-center">
            <div class="order-2 md:order-1 lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                <h1 class="title-font text-4xl sm:text-5xl font-extrabold tracking-tight text-gray-900 mb-4">
                    <span class="block">Stay curious.</span>
                    <span class="block text-gradient">Discover stories,</span>
                    <span class="block text-gradient">thinking, and expertise</span>
                    <span class="block text-gradient">from writers on any topic.</span>
                </h1>
                <p class="mb-8 leading-relaxed text-base text-gray-500 sm:text-lg md:text-xl">
                    The best ideas can change who we are. StoryHub is where those ideas take shape, take off, and spark powerful conversations.
                </p>
                <div class="flex justify-center">
                    <a href="{{ route('register') }}" class="inline-flex text-white bg-black border-0 py-2 px-6 focus:outline-none hover:bg-gray-800 rounded text-lg">
                        Start writing
                    </a>
                    <a href="{{ route('home') }}" class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">
                        Discover stories
                    </a>                    
                </div>
            </div>
            <div class="order-1 md:order-2 lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
                <img class="object-cover object-center rounded" alt="hero" src="{{ asset('images/heroes-illustration.png') }}">
            </div>
        </div>
    </section>        
</x-app.layout>
