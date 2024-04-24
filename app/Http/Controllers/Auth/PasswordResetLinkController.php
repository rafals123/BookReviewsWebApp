<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Dodajemy walidację, czy e-mail istnieje w bazie danych
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            // Jeśli walidacja nie powiedzie się (e-mail nie istnieje w bazie), zwróć błędy walidacji
            throw ValidationException::withMessages([
                'email' => __('Podany e-mail nie istnieje w bazie danych.'),
            ]);
        }

        // Zamiast wysyłania rzeczywistego linku, wyślij tylko komunikat
        return back()->with('status', __('Wysłano link do resetu hasła'));
    }
}
