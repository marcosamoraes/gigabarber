<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(RegisterClientRequest $request)
    {
        $validated = $request->safe()->all();

        try {
            $client = Client::create($validated);
            $client->attributes()->create(['title' => $client->company_name]);

            Auth::guard('web')->loginUsingId($client->uuid);
            return redirect(route('client.dashboard'))->with('success', 'Cadastro realizado com sucesso!');
        } catch (\Exception $e) {
            logError($e, $validated);
            return back()->withErrors([
                'message' => 'Erro ao realizar cadastro, tente novamente.',
            ])->exceptInput('password');
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ], true)) {
            $request->session()->regenerate();

            return back();
        }
        
        return back()->withErrors([
            'email' => 'E-mail ou senha inválidos.',
        ])->onlyInput('email');
    }

    public function forgot_password_view() 
    {
        return view('client.forgot-password');
    }

    public function forgot_password(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? redirect(route('client.login'))->with(['success' => __($status)])
            : redirect(route('client.login'))->withErrors(['email' => __($status)]);
    }

    public function reset_password_view(Request $request) 
    {
        if (!$request->input('token') && !$request->input('email'))
            return redirect(route('client.login'));
            
        return view('client.reset-password', ['token' => $request->input('token'), 'email' => $request->input('email')]);
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
            ? redirect(route('client.login'))->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('client.login'));
    }
}
