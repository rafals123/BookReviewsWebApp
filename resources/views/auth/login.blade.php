
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <!-- Head Section -->
        <style> 
            form {
                padding: 20px;
                border-radius: 10px;
                width: 400px; 
            } 
        </style>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me and Forgot Password -->
        <div class="d-flex flex-col justify-between mt-4">
            <div class="flex flex-row justify-between">
                <label for="remember_me" class="inline-flex">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm ">{{ __('Zapamiętaj mnie') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="ml-auto underline text-sm hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Zapomniałeś hasła?') }}
                    </a>
                @endif
            </div>
            <br>

            <!-- Back and Log In -->
            <div class="text-center">
                <x-secondary-button onclick="window.location='{{ url('/') }}'">Powrót</x-secondary-button> 
                <x-primary-button>
                    {{ __('Zaloguj się') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>
