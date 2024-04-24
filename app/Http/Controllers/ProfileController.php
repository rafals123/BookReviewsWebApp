<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Review;
use App\Models\Book;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
       // $request->user()->surname = $request->validated()['surname'];
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();


          //znalezienie recenzji użytkownika
        $userReviews = Review::where('user_id', $user->id)->get();

        foreach ($userReviews as $review) {
            // Zaktualizuj pola w tabeli books
            $book = $review->book;
            if ($review->recommended) {
                $book->numOfRecommended--;
            } else {
                $book->numOfNotRecommended--;
            }

            $book->ratingSum-=$review->rating;
            $book->ratingCounter-=1;
            $book->save();

            //usuniecie recenzji
            $review->delete();
        }
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
