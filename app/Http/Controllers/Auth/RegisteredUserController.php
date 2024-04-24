<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3','max:50',  'regex:/^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ\s]+$/'],
            'surname' => ['required', 'string', 'min:3', 'max:60', 'regex:/^[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ\s]+(?:-[A-Za-zżźćńółęąśŻŹĆĄŚĘŁÓŃ\s]*)?$/'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'gender' => ['required'],
            'favorite_genres' => ['required','array','min:1'],
            'birth_date' => ['required', 'date', 'before_or_equal:' . now()->subYears(13)->format('Y-m-d')],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'gender' => $request->gender,
            'favorite_genres' => json_encode($request->favorite_genres),
           // 'favorite_genres' => implode(',', $request->favorite_genres),
            'birth_date' => $request->birth_date,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
