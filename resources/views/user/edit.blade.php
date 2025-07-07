<x-app.layout>
    <x-slot:title>
        Update Your Profile | StoryHub
    </x-slot:title>

    <x-app.navbar />

    <section class="container px-4 sm:px-6 lg:px-8 mx-auto my-12">
        {{-- Header --}}
        <div class="border-b border-gray-800/20 pb-6 mb-2">
            <h2 class="text-2xl font-semibold text-gray-800 tracking-tight">
                Edit Your Profile
            </h2>
        </div>

        {{-- Edit Form --}}
        <form action="{{ route('profile.update', ['username' => $user->username]) }}" method="POST" enctype="multipart/form-data"
            class="bg-white shadow-xl rounded-xl px-6 py-8 grid grid-cols-1 md:grid-cols-2 gap-y-8 md:gap-x-8">
            @csrf
            @method('PATCH')
            
            {{-- Avatar Input --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Avatar</label>

                @if ($user->avatar)
                <div class="w-24 h-24 rounded-full overflow-hidden border border-gray-300 my-4">
                    <img src="/storage/{{ $user->avatar }}" alt="{{ $user->name }} Photo" class="w-full h-full object-cover">
                </div>
                @endif

                <input type="file" name="avatar" accept="image/*" 
                    class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4
                        file:rounded file:border-0
                        file:text-sm file:font-semibold
                        file:bg-gray-100 file:text-gray-700
                        hover:file:bg-gray-200 transition">

                @if ($user->avatar)
                <div class="mt-6">
                    <label for="delete_avatar" class="flex items-center space-x-3 text-sm text-red-700 cursor-pointer">
                        <input type="checkbox" id="delete_avatar" name="delete_avatar"
                            class="h-5 w-5 rounded border-gray-300 text-red-600 focus:ring-red-500">
                        <span>Delete current photo</span>
                    </label>
                </div>                
                @endif
            </div>
            
            {{-- Social Media Input --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">Social Media</label>
                <div class="grid grid-cols-1 gap-3">        
                @foreach ($socials as $platform)
                    <input type="url" name="social_media_{{ $platform }}" 
                        placeholder="{{ ucfirst($platform) }} URL" 
                        value="{{ $user->social_media[$platform] ?? '' }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">
                @endforeach
                </div>
            </div>
            
            {{-- Name Input --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
        
            {{-- Email Input --}}
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            {{-- Bio Input --}}
            <div class="md:col-span-2">
                <label for="bio" class="block text-sm font-semibold text-gray-700 mb-2">Bio</label>
                <textarea id="bio" name="bio" rows="4" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm resize-none focus:ring-blue-500 focus:border-blue-500">{{ old('bio', $user->bio) }}</textarea>
            </div>
            
            {{-- Submit --}}
            <div class="md:col-span-2 flex justify-end mt-2">
                <button type="submit" class="inline-block px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                    Save Changes
                </button>
            </div>
        </form>
    </section>

    <x-app.footer />

    @if ($errors->any())
        <x-alerts.error :error="$errors->all()" />
    @endif
</x-app.layout>