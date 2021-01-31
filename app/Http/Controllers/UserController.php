<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('view', 'users');
        return UserResource::collection(User::paginate());
    }

    public function store(UserCreateRequest $request)
    {
        Gate::authorize('edit', 'users');
        $user = User::create($request->all());
        return response($user, Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        Gate::authorize('view', 'users');
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        Gate::authorize('edit', 'users');
        $user->update($request->all());
        return response($user, Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        Gate::authorize('edit', 'users');
        $user->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
