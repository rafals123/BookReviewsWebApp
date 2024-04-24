<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::post('/create',[RegisteredUserController::class,'store'])->name("store");
Route::get('/userReviews', [ReviewController::class, 'show'])->name('userReviews');
Route::get('/addReview',[ReviewController::class,'create'])->name("addReview");
Route::post("/addReview", [ReviewController::class, 'store'])->name('storeReview');
Route::get('/delete/{id}',[ReviewController::class,'destroy'])->name('delete');
Route::get('/edit/{id}', [ReviewController::class,'edit'])->name('edit');
Route::put('/update/{id}', [ReviewController::class,'update'])->name('update');
Route::get('/reviews',[BookController::class,'show'])->name("reviews");
Route::get('/bookReviews/{bookId}', [ReviewController::class, 'showBookReviews'])->name("bookReviews");
Route::post('/reviews', [BookController::class, 'searchBooks'])->name('searchBooks');