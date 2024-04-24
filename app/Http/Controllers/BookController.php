<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
#use App\Http\Requests\SearchBookRequest;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
       // return view('reviews');
        if (Auth::check()) {
            $books = Book::all();
            return view('reviews', ['books' => $books]);
        } else {
            return redirect('login');
        }
    }

    public function searchBooks(Request $request){
        if(Auth::check()){
            if(strlen($request->book) === 0){
                $this->show();
                
            }
            else {
                $books = Book::where('bookTitle', 'like', $request->book.'%')->get();
                
                return view('reviews', ['books' => $books]);
            }
        }
        return redirect('/reviews');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
