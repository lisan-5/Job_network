<x-layout>
    <x-slot:header>
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">{{ $job->title }}</h1>
            @auth
                <form method="POST" action="{{ $job->favoritedBy->contains(auth()->id()) ? route('favorites.destroy', $job) : route('favorites.store', $job) }}">
                    @csrf
                    @if($job->favoritedBy->contains(auth()->id()))
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-2xl">&hearts;</button>
                    @else
                        <button type="submit" class="text-gray-400 hover:text-gray-600 text-2xl">&hearts;</button>
                    @endif
                </form>
            @endauth
        </div>
    </x-slot:header>

    <div x-data="{ showDeleteModal: false }" class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex flex-col md:flex-row justify-between">
            <div class="md:w-3/4">
                <p class="text-sm text-gray-500 mb-2">Posted {{ $job->created_at->diffForHumans() }} by <span class="font-semibold text-gray-700">{{ $job->employer->name }}</span></p>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $job->title }}</h2>
                <p class="text-gray-700 mb-4">{{ $job->description }}</p>
                <p class="text-gray-600 mb-4"><span class="font-semibold">Location:</span> {{ $job->location }}</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($job->tags as $tag)
                        <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="mt-6 md:mt-0 md:w-1/4 flex flex-col space-y-2">
                @can('update', $job)
                    <a href="/jobs/{{ $job->id }}/edit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500 text-center">Edit</a>
                @endcan
                @can('delete', $job)
                    <button @click="showDeleteModal = true" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-500">Delete</button>
                @endcan
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-show="showDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 max-w-md">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Delete Job</h3>
                <p class="text-gray-600 mb-6">Are you sure you want to delete "<span class="font-semibold">{{ $job->title }}</span>"? This action cannot be undone.</p>
                <div class="flex justify-end space-x-4">
                    <button @click="showDeleteModal = false" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Cancel</button>
                    <form method="POST" action="/jobs/{{ $job->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-500">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>