<x-app-layout>
    <style>
        .content
        {
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            align-items: center;
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
        .text
        {
            text-shadow: 2px 2px 4px #000; 
            color: white;
            font-size: 1.1em !important;
        }
    </style>
    <div class="blur-overlay"></div>
    <div class=" container py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"  >
            <div class="overflow-hidden shadow-sm sm:rounded-lg content" >
                <div class="p-6 text">
                Witaj na naszej stronie poświęconej recenzjom książek! Jesteśmy miejscem, gdzie pasjonaci literatury mogą dzielić się swoimi myślami i opiniami na temat fascynujących tytułów. 
                Zapraszamy do dołączenia do naszej społeczności i dzielenia się recenzjami, które pomogą innym czytelnikom wybrać idealną lekturę.<br>

                Niezależnie od tego, czy uwielbiasz powieści kryminalne, popularnonaukowe, czy też horrory, każda recenzja ma znaczenie! 
                Twoje słowa mogą być inspiracją dla innych poszukujących ciekawych historii. Niezwykłe przygody, intrygujące postaci 
                i poruszające wątki – to wszystko możesz odkryć w świecie książek, a także dzielić się tym z innymi entuzjastami.<br>
                Recenzje to nie tylko sposobność do wyrażenia swojej opinii, ale również szansa na zbudowanie społeczności czytelniczej, 
                gdzie wymiana myśli prowadzi do nowych odkryć literackich. Nie wahaj się podzielić swoim spojrzeniem na najnowsze bestsellery 
                lub mało znane perełki literatury – każdy głos ma moc wpływania na wybory czytelników.<br>
                Dołącz do naszej społeczności recenzentów i razem z nami odkrywaj świat literackich przygód. Twoje recenzje są dla nas cenne, 
                a dzięki nim możemy razem tworzyć miejsce, gdzie pasja do czytania łączy nas wszystkich.<br>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-secondary-button><a href="{{route('addReview') }}"> Dodaj recenzję </a></x-secondary-button>
                    <x-secondary-button><a href="{{route('reviews') }}">Zobacz recenzje użytkowników </a></x-secondary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
