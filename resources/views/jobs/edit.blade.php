<x-layout>
    <x-slot:header>
        Edit Job: {{ $job->title }}
    </x-slot:header>

    <form method="POST" action="/jobs/{{ $job->id }}">
        @csrf 
        @method('PATCH') // Use PATCH method to update the job

        <div class="max-w-2xl mx-auto bg-gradient-to-br from-indigo-50 via-white to-blue-50 p-10 rounded-2xl shadow-xl border border-gray-200">
            <div class="flex items-center mb-8">
            
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                <div>
                    <label for="employer_id" class="block text-sm font-semibold text-gray-700 mb-2">Employer</label>
                    <select name="employer_id" id="employer_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        @foreach ($employers as $employer)
                            <option value="{{ $employer->id }}" {{ $employer->id == $job->employer_id ? 'selected' : '' }}>{{ $employer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $job->title) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="Software Engineer" required>
                </div>
                <div>
                    <label for="company" class="block text-sm font-semibold text-gray-700 mb-2">Company</label>
                    <input type="text" name="company" id="company" value="{{ old('company', $job->company) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="Company Name" required>
                </div>
                <div>
                    <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $job->location) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="Location" required>
                </div>
                <!-- created_at is set automatically -->

                @if($errors->any())
                    <div class="col-span-2">
                        <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- @error('title')
                    {{ $message }}
                @endif --}}
            </div>

            <div class="mt-8 flex items-center justify-end gap-x-6">
                <a href="/jobs/{{ $job->id }}" type="button" class="text-sm font-semibold text-black-700 hover:text-red-600 transition">Cancel</a>
                <button type="submit" class="rounded-lg bg-indigo-800 px-6 py-2 text-sm font-bold text-white shadow-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">Update</button>
            </div>
        </div>
    </form>
</x-layout>