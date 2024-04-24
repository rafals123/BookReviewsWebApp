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
                min-height: 100vh;
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

            .area
            {
                background-color: black; 
                color:white; 
                border-radius:10px;
                text-align:center;
                height: 250px;

            }

            #rating 
            {
                color: white; 
                background-color: #1a202c; 
                border-radius: 5px; 
                border: 1px solid #1a202c;
            }
                
        </style>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        @include('layouts.navigation')
        <div class="blur-overlay"></div>
        <div class="container flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
            <h1 class="font-semibold display-4 mb-2">Zmień recenzję</h1>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 form shadow-md overflow-hidden sm:rounded-lg ">
                <form role="form" id="comment-form" method="post" action="{{ route('update', $review) }}">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
                    <div>
                    <!--  <div class="box-body">
                  <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}"
                    id="roles_box">-->
                    <x-input-label for="review" :value="__('Recenzja')" />
                    <textarea name="review" id="review" class="block mt-1 w-full select-input area" required minlength="10" > 
                    {{$review->review}}
                    </textarea>
                    </div>


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

                    <div class="mt-4">
                        <x-input-label for="recommended" :value="__('Czy polecasz książkę?')" />
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="recommended" value="1" class="form-radio" {{ $review->recommended ? 'checked' : '' }}>
                                    <span class="ml-2 text-white">Polecam</span>
                                </label>
                                <label class="inline-flex items-center ml-6">
                                    <input type="radio" name="recommended" value="0" class="form-radio" {{ !$review->recommended ? 'checked' : '' }}>
                                    <span class="ml-2 text-white">Nie polecam</span>
                                </label>
                            </div>
                        <x-input-error :messages="$errors->get('recommended')" class="mt-2" />
                    </div>


                    <div class="box-footer">
                   <x-primary-button class="ms-4">Zapisz</x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </body>
</html>