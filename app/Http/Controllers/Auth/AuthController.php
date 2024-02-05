<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function create()
    {
        return view('auth.login');
    }


    public function login(LoginRequest $request)
    {

        $user = User::query()->where('email', $request->get('email'))->first();

        if (!$user || !Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            throw ValidationException::withMessages([
                'name' => trans('auth.failed'),
            ]);
        }

        Auth::loginUsingId($user->id);
        
        return redirect('/');
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return back();
    }


}

