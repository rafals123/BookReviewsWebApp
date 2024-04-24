<x-guest-layout>
    <style> 
        form {
            padding: 20px;
            border-radius: 10px;
            width: 400px;    
        } 
        
    </style>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Imię -->
        <div>
            <x-input-label for="name" :value="__('Imię')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" minlength="3" maxlength="50"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

       <!-- Nazwisko -->
        <div>
            <x-input-label for="surname" :value="__('Nazwisko')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autocomplete="family-name" minlength="3" maxlength="60"/>
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
        </div>
        

        <!-- Adres email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Adres email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


        <!-- Płeć -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Płeć')" />
            <div>
                <label class="inline-flex items-center">
                    <input type="radio" name="gender" value="male" class="form-radio" checked>
                    <span class="ml-2 text-white">Mężczyzna</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" name="gender" value="female" class="form-radio">
                    <span class="ml-2 text-white">Kobieta</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

       <!-- Ulubione gatunki -->
       <div class="mt-4 d-flex flex-wrap grid grid-cols-2 gap-3">
            <x-input-label for="favorite_genres[]" :value="__('Ulubione gatunki książek')" />
            <label class="inline-flex items-center ">
                <input type="checkbox" name="favorite_genres[]" value="horror" class="form-checkbox">
                <span class="ml-2 text-white">Horror</span>
            </label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="favorite_genres[]" value="crime" class="form-checkbox">
                <span class="ml-2 text-white">Kryminał</span>
            </label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="favorite_genres[]" value="history" class="form-checkbox">
                <span class="ml-2 text-white">Historyczne</span>
            </label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="favorite_genres[]" value="self_development" class="form-checkbox">
                <span class="ml-2 text-white">Rozwój osobisty</span>
            </label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="favorite_genres[]" value="fantasy" class="form-checkbox">
                <span class="ml-2 text-white">Fantasy</span>
            </label>
            <label class="inline-flex items-center ">
                <input type="checkbox" name="favorite_genres[]" value="popular_science" class="form-checkbox">
                <span class="ml-2 text-white">Popularnonaukowe</span>
            </label>
        </div>

        
        <!-- Data urodzenia -->
        <div class="mt-4">
            <x-input-label for="birth_date" :value="__('Data urodzenia')" />
            <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')" required />
            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
        </div>
 
        <!-- Hasło -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Hasło')" minlength="8" maxlength="100"/>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Potwierdź hasło -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Potwierdź hasło')" minlength="8" maxlength="100"/>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-flex flex-col justify-between mt-4">
            <div class="flex flex-row justify-between">
                <a class="underline text-sm hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 me-2" href="{{ route('login') }}">
                    {{ __('Już zarejestrowany?') }}
                </a>
                </div>
            <br>
            <div class="text-center">

                <x-secondary-button onclick="window.location='{{ url('/') }}'">Powrót</x-secondary-button>

                <x-primary-button class="ms-4">
                    {{ __('Zarejestruj') }}
                </x-primary-button>
            </div>

    </form>
</x-guest-layout>