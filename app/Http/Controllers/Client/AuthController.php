<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Client;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'birthdate' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'whatsapp' => ['required'],
            'email' => ['required', 'email', 'unique:clients'],
            'password' => ['required', 'confirmed', 'min:6'],
            'image' => ['required', 'image'],
            'document_image' => ['required', 'image'],
            'images' => ['required'],
        ]);

        $validated['image'] = $this->save_image_file($validated['image'], 'images/clients');
        $validated['document_image'] = $this->save_image_file($validated['document_image'], 'images/clients/documents');

        $validated['birthdate'] = implode('-', array_reverse(explode('/', $validated['birthdate'])));
        $validated['password'] = Hash::make($validated['password']);

        $images = $validated['images'];
        unset($validated['images']);

        $validated['active'] = true;
        $validated['last_access'] = true;

        try {
            $client = Client::create($validated);

            foreach ($images as $image) {
                $image = $this->save_image_file($image, 'images/clients');
                $client->images()->create(['link' => $image]);
            }
        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Erro ao realizar cadastro, tente novamente.',
            ])->exceptInput('password');
        }

        Auth::guard('web')->loginUsingId($client->id);
        return redirect('/dashboard?link=meus-dados')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'active' => true
        ], true)) {
            $request->session()->regenerate();

            return back();
        }

        return back()->withErrors([
            'email' => 'E-mail ou senha inválidos.',
        ])->onlyInput('email');
    }

    public function forgot_password(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['status' => __($status)])
            : response()->json(['email' => __($status)]);
    }

    public function reset_password_view(Request $request) 
    {
        if (!$request->input('token') && !$request->input('email'))
            return redirect('/');
            
        return view('reset-password', ['token' => $request->input('token'), 'email' => $request->input('email')]);
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('/')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
