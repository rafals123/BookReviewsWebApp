<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twoje recenzje</title>

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
            max-width: 1200px;
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

        .btn-red, .btn-green {
            background-color: #ff0000;
            color: #ffffff; 
            border: 1px solid #ff0000; 
            border-radius: 5px; 
            padding: 3px 5px; 
            font-weight: bold;
            font-size:14px;
        }
        .btn-green
        {
            background-color: green;
            border: 1px solid green; 
           
        }
    </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    @include('layouts.navigation')
    <div class="blur-overlay"></div>
    @if($reviews->count() > 0)
    <div class="container flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
        <h1 class="font-semibold display-4 mb-2">Sprawdź wszystkie swoje recenzje!</h1></div>
    
        
   
    <table data-toggle="table">
        <thead>
            <tr>
                <th>Tytuł książki</th>
                <th>Imię i nazwisko autora</th>
                <th>Recenzja</th>
                <th>Czy polecasz?</th>
                <th>Twoja ocena</th>
                <th>Data edycji recenzji</th>
                <th>Edytuj lub usuń</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                
                <td>{{$review->book->bookTitle}}</td>
                <td>{{$review->book->authorName}} {{$review->book->authorSurname}} </td>
                <td>{{$review->review}}</td>
                <td>{{$review->recommended ? 'Tak' : 'Nie'}}</td>
                <td>{{$review->rating}}  </td>
                <td>{{$review->updated_at->format('Y-m-d')}}</td>
                <td>
                    @if($review->user_id == \Auth::user()->id)
                        <a href="{{ route('delete', $review->id) }}"
                        class="btn-red"
                        onclick="return confirm('Jesteś pewien?')"
                        title="Skasuj"> Usuń</a>
                        <br><br>
                        <a href="{{ route('edit', $review) }}" class="btn-green"
                        title="Edytuj"> Edytuj </a>
                    @endif
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