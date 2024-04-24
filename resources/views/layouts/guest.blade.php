<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>
                .form {
                    background: linear-gradient(45deg, #B9A540, #9C6A29, #AE4B0A);  
                    
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
                    padding-bottom:20px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
              
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
            <div>
                <a href="/">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 form shadow-md overflow-hidden sm:rounded-lg ">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
