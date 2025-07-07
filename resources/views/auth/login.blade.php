<x-app.layout>
    <x-slot:title>
        Login | StoryHub
    </x-slot:title>

    <div class="w-screen min-h-screen flex items-center justify-center bg-gray-50 px-4 sm:px-6 lg:px-8">
        <div class="relative py-3 sm:max-w-md sm:mx-auto">
            <div class="min-h-96 px-8 py-6 mt-4 text-left bg-white rounded-xl shadow-lg">
                <div class="flex flex-col justify-center items-center h-full select-none">
                    <div class="flex flex-col items-center justify-center gap-2 mb-8">
                        <p class="text-base font-semibold text-gray-800">Sign in to continue</p>
                        <span class="text-sm max-w-[90%] text-center text-gray-500">
                            Access your account to write, read, and connect with others.
                        </span>
                    </div>
                    
                    <form action="{{ route('login.store') }}" method="POST" class="w-full">
                        @csrf

                        <x-form.input name="email" title="Email Address" icon="fa-envelope" type="email" />
                        <x-form.input name="password" title="Password" icon="fa-lock" type="password" />
                        
                        <x-form.button>
                            Login
                        </x-form.button>
                    </form>
            
                    <p class="mt-4 text-sm text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">Create one</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <x-alerts.error :error="$errors->all()" />
    @endif
</x-app.layout>