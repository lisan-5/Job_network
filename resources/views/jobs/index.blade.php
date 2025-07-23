<x-layout>
    <x-slot:header>
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <div class="flex items-center space-x-4 w-full md:w-auto">
                <span class="text-3xl font-bold text-indigo-800">Jobs</span>
                <form action="/jobs" method="GET" class="w-full md:w-auto">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search jobs..."
                        class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" />
                </form>
            </div>
            @auth
                <a href="/jobs/create"
                   class="inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-2 rounded-xl shadow-lg font-semibold hover:bg-indigo-500 transition duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    Create Job
                </a>
            @endauth
        </div>
    </x-slot:header>

    <div class="container mx-auto py-8">
        @if (!empty($success))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-800 rounded-lg">
                {{ $success }}
            </div>
        @endif
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Available Jobs</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($jobs as $job)
                <a href="/jobs/{{ $job->id }}" class="relative flex flex-col bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-lg transition-colors">
                    @auth
                        <form method="POST" action="{{ $job->favoritedBy->contains(auth()->id()) ? route('favorites.destroy', $job) : route('favorites.store', $job) }}" class="absolute top-4 right-4">
                            @csrf
                            @if($job->favoritedBy->contains(auth()->id()))
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-2xl">&hearts;</button>
                            @else
                                <button type="submit" class="text-gray-400 hover:text-gray-600 text-2xl">&hearts;</button>
                            @endif
                        </form>
                    @endauth
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
                    <span class="mt-auto text-primary font-medium hover:underline">View Details &rarr;</span>
                </a>
            @endforeach
        </div>
        <div class="mt-9 flex justify-center">
            {{ $jobs->links() }}
        </div>
    </div>
</x-layout>