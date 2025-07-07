<x-app.layout>
    <x-slot:title>
        Search | StoryHub
    </x-slot:title>

    <x-app.navbar />

    <section class="container px-8 mx-auto mt-8 mb-4">
        <h2 class="text-xl font-semibold text-gray-700">Searching for {{ $query }} </h2>
    </section>

    <section class="container mx-auto px-4 sm:px-6 lg:px-8 divide-y-2 divide-gray-100">
        @if ($posts->isEmpty() && $users->isEmpty())
            <div class="text-center text-gray-500 py-6">
                <p class="text-lg">No posts or users found matching your search.</p>
            </div>
        @else
            @foreach ($posts as $post)
                <x-card.blog :post="$post" />
            @endforeach

            @foreach ($users as $user)
                <x-card.user :user="$user"/>
            @endforeach
        @endif
    </section>

    <x-app.footer />
</x-app.layout>