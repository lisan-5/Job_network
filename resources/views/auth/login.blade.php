<x-layout>
    <x-slot:header>
        Login
    </x-slot:header>

    <form method="POST" action="/login">
        @csrf

        <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <p class="mb-8 text-gray-600 text-center">Login to account</p>

            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" id="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
    

                @if($errors->any())
                    <div>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="mt-8 flex items-center justify-end gap-x-6">
                <a href="/" class="text-sm font-semibold text-gray-700 hover:text-gray-900">Cancel</a>
                <button type="submit" class="rounded-lg bg-indigo-800 px-6 py-2 text-sm font-bold text-white hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">Login</button>
            </div>
        </div>
    </form>
</x-layout>