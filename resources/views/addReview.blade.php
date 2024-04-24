<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj recenzję</title>
    <style>
        .form {
            background: linear-gradient(45deg, #B9A540, #9C6A29, #AE4B0A);  
            padding: 20px;
            border-radius: 10px;
            width: 400px; 
       
        }
        .form label, .form span {
            color: white;
            
        }
        body {
                background-image: url('/zdjecia/tlo4.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                margin: 0;
                min-height: 100vh; 
            }

        .blur-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            filter: saturate(10%);
            filter: sepia(10%);
            z-index: -1; 
        }

        .container {
            position: relative;
            z-index: 1;
            text-align: center; 
            padding: 20px;
            color: white; 
        }
   
        h1{      
            text-shadow: 6px 6px 12px #000; 
            color: #D09623;
            font-size: 1.5em !important;
        }

        h1:hover {
            transition: color 0.3s ease; 
            color: #EFB238;

        }

        .select-input {
          
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            color: white;
            background-color: #1a202c; 
            border: 1px solid #555; 
        }

        .select-input:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            border-color: #007BFF; 
        }

        #rating 
        {
            color: white; 
            background-color: #1a202c; 
            border-radius: 5px; 
            border: 1px solid #1a202c;
        }

    </style>

</head>
<!-- Scripts -->
 @vite(['resources/css/app.css', 'resources/js/app.js'])
 <body class="font-sans text-gray-900 antialiased">
    <div class="blur-overlay"></div>
    <div class="container flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
        <h1 class="font-semibold display-4 mb-2">Dodaj recenzję do wybranej książki</h1>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 form shadow-md overflow-hidden sm:rounded-lg ">
            <form method="POST" action="{{ route('storeReview') }}" class="form">
                @csrf
                <!-- Imię autora-->
                <div>
                    <x-input-label for="authorName" :value="__('Imię autora')" />
                    <x-text-input id="authorName" class="block mt-1 w-full" type="text" name="authorName" :value="old('authorName')" required autofocus minlength="3" maxlength="50"/>
                    <x-input-error :messages="$errors->get('authorName')" class="mt-2" />
                </div>

                <!-- Nazwisko autora  -->
                <div>
                    <x-input-label for="authorSurname" :value="__('Nazwisko autora')" />
                    <x-text-input id="authorSurname" class="block mt-1 w-full" type="text" name="authorSurname" :value="old('authorSurname')" required minlength="3" maxlength="60"/>
                    <x-input-error :messages="$errors->get('authorSurname')" class="mt-2" />
                </div>
                

               <!-- Tytuł książki  -->
                <div>
                    <x-input-label for="bookTitle" :value="__('Tytuł książki')" />
                    <x-text-input id="bookTitle" class="block mt-1 w-full" type="text" name="bookTitle" :value="old('bookTitle')" required minlength="2" maxlength="70"/>
                    <x-input-error :messages="$errors->get('bookTitle')" class="mt-2" />
                </div>

                <!-- Rok wydania książki  -->
                <div>
                    <x-input-label for="releaseDate" :value="__('Rok wydania książki')" />
                    <x-text-input id="releaseDate" class="block mt-1 w-full" type="number" name="releaseDate" :value="old('releaseDate')" required autocomplete="family-name" min=0 max=2024/>
                    <x-input-error :messages="$errors->get('releaseDate')" class="mt-2" />
                </div>

                <!-- Gatunek książki  -->
                <div>
                    <x-input-label for="genre" :value="__('Gatunek książki')" />
                    <select id="genre" name="genre"  class="block mt-1 w-full select-input" required>
                        <option value="horror">Horror</option>
                        <option value="kryminał">Kryminał</option>
                        <option value="historyczne">Historyczne</option>
                        <option value="rozwój osobisty">Rozwój osobisty</option>
                        <option value="fantasy">Fantasy</option>
                        <option value="popularnonaukowe">Popularnonaukowe</option>
                        <option value="romans">Romans</option>
                        <option value="science fiction">Science Fiction</option>
                        <option value="thriller">Thriller</option>
                        <option value="dramat">Dramat</option>
                        <option value="inne">Inne</option>
                    </select>
                    <x-input-error :messages="$errors->get('genre')" class="mt-2" />
                </div>

                <!-- Recenzja -->
                <div>
                    <x-input-label for="review" :value="__('Recenzja')" />
                    <textarea id="review" name="review" class="block mt-1 w-full select-input" required minlength="10"></textarea>
                    <x-input-error :messages="$errors->get('review')" class="mt-2" />
                </div>

                <!-- Rating w skali 1-10 -->
                <div>
                    <x-input-label for="rating" :value="__('Oceń')" />
                    <select name="rating" id="rating">
                        <?php
                            for ($i = 1; $i <= 10; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                </div>

                <!-- Polecam/Nie polecam -->
                <div class="mt-4">
                    <x-input-label for="recommended" :value="__('Czy polecasz książkę?')" />
                    <div>
                        <label class="inline-flex items-center">
                            <input type="radio" name="recommended" value="1" class="form-radio" checked>
                            <span class="ml-2 text-white">Polecam</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="recommended" value="0" class="form-radio">
                            <span class="ml-2 text-white">Nie polecam</span>
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('recommended')" class="mt-2" />
                </div>

                
                <div class="text-center">

                <x-secondary-button><a href="{{route('dashboard') }}">Powrót</a></x-secondary-button>
                    <x-primary-button class="ms-4">
                        {{ __('Dodaj recenzję') }}
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>

    @if (session('success'))
        <script>
            alert("{{ session('success') }}");
            location.reload(true);
        </script>
    @endif

    @if (session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif
</body>
</html>