<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Articles') }} <small>({{ $articles->count() }})</small>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <form action="{{ url('articles/search') }}" method="get">
                    <div class="mb-4">
                        <input type="text" name="q" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" placeholder="Search..." value="{{ request('q') }}" />
                    </div>
                </form>
                @forelse ($articles as $article)
                    <article class="mb-4">
                        <h2 class="dark:text-white font-semibold">{{ $article->id }}. {{ $article->title }}</h2>
                        <p class="m-0 dark:text-gray-200">{{ $article->body }}</body>
                        <div class="flex gap-4">
                            @foreach ($article->tags as $tag)
                                <span class="inline-block px-2 py-1 bg-red-500 text-white rounded-md">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </article>
                @empty
                    <p>No articles found</p>
                @endforelse
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-app-layout>