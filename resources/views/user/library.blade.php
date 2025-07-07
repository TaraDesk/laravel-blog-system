<x-app.layout>
    <x-slot:title>
        {{ Auth::user()->name }} Library | StoryHub
    </x-slot:title>

    <x-app.navbar />

    <section class="container px-8 mx-auto mt-8 mb-4">
        @if (count($liked) == 0)
            <div class="text-center text-gray-500 mt-12">
                There are no post in your library to show right now.
            </div>  
        @else
            @foreach ($liked as $post)
                <x-card.blog :post="$post" />
            @endforeach
        @endif
    </section>

    <x-app.footer />
</x-app.layout>