<x-layout>
    <x-slot:header>
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-indigo-800">My Favorites</h1>
            @auth
                <a href="/jobs" class="inline-flex items-center gap-2 bg-gray-200 text-gray-800 px-5 py-2 rounded-xl shadow font-semibold hover:bg-gray-300 transition duration-200">
                    View All Jobs
                </a>
            @endauth
        </div>
    </x-slot:header>

    <div class="container mx-auto py-8">
        @if($jobs->isEmpty())
            <p class="text-gray-600">You have not favorited any jobs yet.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($jobs as $job)
                    <div class="relative flex flex-col bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-lg transition-colors">
                        @auth
                            <form method="POST" action="{{ route('favorites.destroy', $job) }}" class="absolute top-4 right-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-2xl">&hearts;</button>
                            </form>
                        @endauth
                        <a href="/jobs/{{ $job->id }}" class="flex-grow">
                            <div class="flex justify-between items-center mb-2">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $job->title }}</h2>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $job->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                {{ $job->company }} in {{ $job->location }}
                            </p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($job->tags as $tag)
                                    <span class="px-2 py-1 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 text-xs rounded-full">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-9 flex justify-center">
                {{ $jobs->links() }}
            </div>
        @endif
    </div>
</x-layout>
