<x-layout>
    <x-slot:header>
        Delete Job: {{ $job->title }}
    </x-slot:header>

    <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-200 mt-10">
        <h2 class="text-xl font-bold text-red-700 mb-4">Are you sure you want to delete this job?</h2>
        <p class="mb-6 text-gray-700">This action cannot be undone.</p>
        <form method="POST" action="/jobs/{{ $job->id }}">
            @csrf
            @method('DELETE')
            <div class="flex gap-4 justify-end">
                <a href="/jobs/{{ $job->id }}" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300">Cancel</a>
                <button type="submit" class="px-4 py-2 rounded-lg bg-red-700 text-white font-bold hover:bg-red-800">Delete</button>
            </div>
        </form>
    </div>
</x-layout>
