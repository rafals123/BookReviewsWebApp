<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recenzje użytkowników</title>

    <style>
       
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
            min-height: 100vh;
        }

        .container {
            position: relative;
            z-index: 1; 
            text-align: center; 
            padding: 20px;
            color: white; 
          
            display: flex;
    flex-direction: column;
    justify-content: center;
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

                
        table {
            background: linear-gradient(145deg, #B9A540, #9C6A29, #AE4B0A);  
            padding: 20px;
            border-radius: 10px;
            max-width: 900px;
            margin: 0 auto;
            width: 100%;    
            margin-bottom: 20px;        
        }

        th, td {
            text-align: center;
            color: white;
            text-shadow: 2px 2px 6px #000; 
        }
        th
        {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size:1.1em;
        
        }
        td
        {
            font-family: 'Roboto', sans-serif;
            padding:10px;
            margin:15px;
        }

        .btn-green {
            background-color: green !important;
            border: 1px solid green !important; 
            color: #ffffff !important;    
            border-radius: 5px !important; 
            padding: 3px 3px !important; 
            font-weight: bold !important; 
            font-size: 14px !important;
        
        }


    </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    @include('layouts.navigation')
    <div class="blur-overlay"></div>
    @if($books->count() > 0)
    <div class="container flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
        <h1 class="font-semibold display-4 mb-2">Sprawdź recenzje książek dodane przez naszych użytkowników!</h1></div>
        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="text-align:center;">
                <form method="POST" action="{{ route('searchBooks') }}">

                    @csrf
                    <div>
                    <x-input-label for="book" :value="('Wyszukaj książkę')" style="color: #D09623; text-align:center; font-size:18px;"/>
                        <x-text-input id="book" class="block mt-1 w-full" type="text" name="book"/>
                        <x-input-error :messages="$errors->get('book')" class="mt-2" style="color:yellow" />
                    </div>
                    <button type="submit" class="btn-green">Szukaj</button>
                </form>
        </div>
   
        <br>
        <table data-toggle="table">
        <thead>
            <tr>
                <th>Tytuł książki</th>
                <th>Imię i nazwisko autora</th>
                <th>Rok wydania</th>
                <th>Liczba polecanych</th>
                <th>Liczba niepolecanych</th>
                <th>Średnia ocen</th>
                <th>Recenzje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                
                <td>{{$book->bookTitle}}</td>
                <td>{{$book->authorName}} {{$book->authorSurname}} </td>
                <td>{{$book->releaseDate}}</td>
                <td>{{$book->numOfRecommended}}</td>
                <td>{{$book->numOfNotRecommended}}</td>
                @if($book->ratingCounter === 0)
                    <td>0</td>
                @else
                    <td>{{round($book->ratingSum/$book->ratingCounter,2)}}</td>
                @endif
                <td>
                <a href="{{ route('bookReviews', ['bookId' => $book->id]) }}" class="btn-green" title="Sprawdz">Sprawdź</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="container flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
        <h1 class="font-semibold display-4 mb-2">Brak recenzji do wyświetlenia.</h1>
        <div class="p-6 text-gray-900 dark:text-gray-100">
        <x-secondary-button><a href="{{route('addReview') }}"> Dodaj recenzję </a></x-secondary-button>
        </div>
    </div>

    @endif
        
</body>
</html>