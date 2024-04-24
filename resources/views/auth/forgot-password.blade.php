<x-guest-layout>
    <div class="mb-4 text-sm text-center" style="color: white;">
        {{ __('Zapomniałeś hasła? Bez problemu. Po prostu podaj nam swój adres e-mail, a my wyślemy Ci link do resetowania hasła, który umożliwi Ci wybranie nowego.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4 space-x-4">
        <x-secondary-button onclick="window.location='{{ url('/') }}'">Powrót</x-secondary-button> 
            <x-primary-button onclick="resetPassword()">
                {{ __('Kliknij, aby zresetować hasło') }}
            </x-primary-button>
        </div>
    </form>
    <script>
        function resetPassword() {
           
            //alert("Wysłano link do resetu hasła na podany adres email");
            location.reload();
        }
    </script>
</x-guest-layout>
