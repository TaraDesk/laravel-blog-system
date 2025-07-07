<x-app.layout>
    <x-slot:title>
        Home | StoryHub
    </x-slot:title>

    <x-app.navbar />

    <section class="container px-4 py-2 mx-auto">
        <div class="flex flex-wrap gap-4 overflow-x-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 py-4 px-2 bg-white">
            <x-app.menu category="all" />
            @foreach ($categories as $category)
                <x-app.menu category="{{ $category->name }}" />
            @endforeach
        </div>
    </section>

    <section class="container mx-auto px-4 sm:px-6 lg:px-8 divide-y-2 divide-gray-100" id="posts-container">
        @foreach ($posts as $post)
            <x-card.blog :post="$post" />
        @endforeach
    </section>

    <x-app.footer />

    @if (session('success'))
        <x-alerts.success :flash="session('success')"/>
    @endif
</x-app.layout>