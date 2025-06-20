<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Services\PasswordService;

class PasswordController extends Controller
{
    private $service;

    public function __construct(PasswordService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('pages.user.password-reset', ['message' => '', 'status' => 'firstAcess']);
    }
    
    public function sendEmail(Request $request)
    {
        
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        
        $result = $this->service->sendEmail($request->input('email'));
        return $result;
        
    }

    public function editPassword(Request $request)
    {
        return view('pages.user.password-reset-form', ['request' => $request]);
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $result = $this->service->resetPassword($request->all());
        return $result;
    }
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
