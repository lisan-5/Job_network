<x-layout>
    <x-slot:header>
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-indigo-800">My Jobs</h1>
            @auth
                <a href="/jobs/create" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-2 rounded-xl shadow-lg font-semibold hover:bg-indigo-500 transition duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    Create Job
                </a>
            @endauth
        </div>
    </x-slot:header>

    <div class="container mx-auto py-8">
        @if($jobs->isEmpty())
            <p class="text-gray-600">You haven't posted any jobs yet.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($jobs as $job)
                    <a href="/jobs/{{ $job->id }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
                        <div class="flex justify-between items-center mb-2">
                            <h2 class="text-xl font-semibold text-gray-800">{{ $job->title }}</h2>
                            <span class="text-sm text-gray-500">{{ $job->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-600 mb-4">
                            {{ $job->company }} in {{ $job->location }}
                        </p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($job->tags as $tag)
                                <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                        <span class="inline-block text-indigo-600 font-medium hover:underline">View Details &rarr;</span>
                    </a>
                @endforeach
            </div>
            <div class="mt-9 flex justify-center">
                {{ $jobs->links() }}
            </div>
        @endif
    </div>
</x-layout>
