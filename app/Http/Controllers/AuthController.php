<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthUpdateRequest;
use App\Http\Requests\AuthPasswordRequest;
use App\Http\Requests\AuthRegisterRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user  = Auth::user();
            $token = $user->createToken('admin')->accessToken;
            return ['token' => $token];
        }
        return response(['error' => 'Invalid Credentials', Response::HTTP_UNAUTHORIZED]);
    }

    public function register(AuthRegisterRequest $request)
    {
        $user = User::create($request->all());
        return response(new UserResource($user), Response::HTTP_CREATED);
    }

    public function profile()
    {
        return Auth::user();
    }

    public function update(AuthUpdateRequest $request)
    {
        Auth::user()->update($request->all());
        return response(new UserResource(Auth::user()), Response::HTTP_ACCEPTED);
    }

    public function password(AuthPasswordRequest $request)
    {
        Auth::user()->update([$request->password]);
        return response(Auth::user(), Response::HTTP_ACCEPTED);
    }
}
