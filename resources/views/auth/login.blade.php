<x-guest-layout>
    {{-- Status session (misalnya setelah reset password) --}}
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">
                Email
            </label>
            <input id="email" type="email" name="email"
                   value="{{ old('email') }}"
                   required autofocus autocomplete="username"
                   class="mt-1 block w-full border-gray-300 rounded shadow-sm" />

            @if(isset($errors) && $errors->has('email'))
                <p class="mt-2 text-sm text-red-600">
                    {{ $errors->first('email') }}
                </p>
            @endif
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">
                Password
            </label>
            <input id="password" type="password" name="password"
                   required autocomplete="current-password"
                   class="mt-1 block w-full border-gray-300 rounded shadow-sm" />

            @if(isset($errors) && $errors->has('password'))
                <p class="mt-2 text-sm text-red-600">
                    {{ $errors->first('password') }}
                </p>
            @endif
        </div>

        <!-- Remember Me -->
        <div class="mb-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ms-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end">
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Log in
            </button>
        </div>
    </form>
</x-guest-layout>