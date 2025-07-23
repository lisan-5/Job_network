<x-layout>
    <x-slot:header>
        <h1 class="text-3xl font-bold text-indigo-800">Profile</h1>
    </x-slot:header>

    <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-200">
        @if(session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="space-y-4">
                <div>
                    <label for="first_name" class="block text-sm font-semibold text-gray-700">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-semibold text-gray-700">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
                @if($errors->any())
                    <div class="text-sm text-red-600">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500">Save</button>
            </div>
        </form>
    </div>
</x-layout>
