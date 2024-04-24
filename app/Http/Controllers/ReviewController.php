<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return view('reviews');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $review = new Review;
        if(Auth::check())
        {
            return view('addReview',['review' => $review]);
        }
        else return redirect('login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'authorName' => ['required', 'string', 'min:3', 'max:50', 'regex:/^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ\s]+$/'],
            'authorSurname' => ['required', 'string', 'min:3', 'max:60', 'regex:/^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ\s]+(-[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ\s]+)?$/'],
            'bookTitle' => ['required', 'string', 'min:2', 'max:70', 'regex:/^[^\'"]+[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ\s.,:\'";!?]+[^\'"]*$/'],
            'releaseDate' => ['required', 'numeric', 'between:0,2024'],
            'genre' => ['required'],
            'review' => ['required', 'string', 'min:10', 'max:1000'],
            'recommended' => ['required', 'boolean'],
        ]);

        $existingBook = Book::where([
            'bookTitle' => $request->input('bookTitle'),
            'authorName' => $request->input('authorName'),
            'authorSurname' => $request->input('authorSurname'),
        ])->first();
        
        $userId = Auth::id();

        if (!$existingBook) {
            $newBook = new Book();
            $newBook->bookTitle = $request->input('bookTitle');
            $newBook->authorName = $request->input('authorName');
            $newBook->authorSurname = $request->input('authorSurname');
            $newBook->releaseDate = $request->input('releaseDate');
            $newBook->genre = $request->input('genre');
            $newBook->numOfRecommended = 0;
            $newBook->numOfNotRecommended = 0;
            $newBook->ratingSum = $request->input('rating');
            $newBook->ratingCounter = 1;

            // Zaktualizuj licznik poleceń i niepoleceń w istniejącej książce
            if ($request->input('recommended')) {
                $newBook->numOfRecommended += 1;
            } else {
                $newBook->numOfNotRecommended += 1;
            }
        
            $newBook->save();

            $review = new Review();
            $review->review = $request->input('review');
            $review->recommended = $request->input('recommended');
            $review->rating = $request->input('rating');
            $review->user_id = $userId;
            $review->book_id = $newBook->id;
            $review->save();

            
            try {
                return redirect()->back()->with('success', 'Dodano recenzję!');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Nie udało się dodać recenzji. ' . $e->getMessage());
            }

        } else {

            $existingReview = Review::where('user_id', Auth::id())
            ->whereHas('book', function ($query) use ($request) {
                $query->where('bookTitle', $request->input('bookTitle'))
                      ->where('authorName', $request->input('authorName'));
            })->first();

            if(!$existingReview)
            {
                $existingBook->ratingSum += $request->input('rating');
                $existingBook->ratingCounter += 1;

                $review = new Review();
                $review->review = $request->input('review');
                $review->recommended = $request->input('recommended');
                $review->rating = $request->input('rating');
                $review->user_id = $userId;
                $review->book_id = $existingBook->id;

                    
                    if ($request->input('recommended')) {
                        $existingBook->numOfRecommended += 1;
                    } else {
                        $existingBook->numOfNotRecommended += 1;
                    }
                    $existingBook->save();
                $review->save();

            
                try {
            
                    return redirect()->back()->with('success', 'Dodano recenzję!');
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Nie udało się dodać recenzji. ' . $e->getMessage());
                }

            }
            else {
                return redirect()->back()->with('error', 'Dodałeś już wcześniej recenzję dla tej książki.');
            }
            
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Review $review)
{
    if (Auth::check()) {
        $reviews = Review::where('user_id', '=', Auth::id())->orderBy('created_at', 'asc')->get();
        return view('userReviews', ['reviews' => $reviews]);
    } else {
        return redirect('login');
    }
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Auth::check())
        {
        $review = Review::find($id);
        
            return view('reviewEditForm', ['review'=>$review]);
        }
        else return redirect('login');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::check()) {
            $review = Review::find($id);
            $oldRecommendedValue = $review->recommended;
        
            $review->review = $request->review;
            $review->recommended = $request->recommended;

            $book = $review->book;
            $book->ratingSum -= $review->rating; 

            $review->rating = $request->rating;
            if ($review->save()) {
             
                if ($oldRecommendedValue != $request->recommended) {
                   
                    if ($oldRecommendedValue) {
                        $book->numOfRecommended -= 1;
                    } else {
                        $book->numOfNotRecommended -= 1;
                    }
        
                    if ($request->recommended) {
                        $book->numOfRecommended += 1;
                    } else {
                        $book->numOfNotRecommended += 1;
                    }
                   
                }
                 
                $book->ratingSum += $review->rating;
                   

                if($book->save())
                {
                    return redirect()->route('userReviews');
                }
               // return redirect()->route('userReviews');
            }
        
           // return "Wystąpił błąd.";

        }
        return redirect('/login');
    }
   
    /**
     * 
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        if (Auth::check()) {
            // Znajdź recenzję o danych id:
            $review = Review::find($id);
            // Znajdź książkę powiązaną z recenzją:
            $book = $review->book;

            if ($review->recommended) {
                $book->decrement('numOfRecommended');
            } else {
                $book->decrement('numOfNotRecommended');
            }
            $book->ratingSum -= $review->rating;
            $book->ratingCounter -= 1;
            Book::where('id', '=', $book->id)->update([
                'ratingSum' => $book->ratingSum,
                'ratingCounter' => $book->ratingCounter
            ]);
            // Usuń recenzję:
            if ($review->delete()) {
                return redirect()->route('userReviews');
            } else {
                return back();
            }
        } else return redirect('/login');
    }

    public function showBookReviews(int $bookId)
    {
        if (Auth::check()) {
            $book = Book::find($bookId);
            $bookReviews = $book->reviews;
            return view('bookReviews', [
                'bookReviews' => $bookReviews,
            ]);

        } else {
            return redirect('login');
        }


    }

}

