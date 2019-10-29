<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\User;

class AuthController extends Controller
{

    public function register(UserRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);
        return response(['status' => 'Success', 'user' => $user], 201);
    }

    public function login(AuthRequest $request)
    {
        $validatedData = $request->validated();

        if (!auth()->attempt($validatedData)) {
            return response(['status' => 'Unauthorized', 'message' => 'Invalid credentials'], 401);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'auth' => ['access_token'=> $accessToken]], 200);
    }

    public function user()
    {
        return response(['user' => auth('api')->user()]);
    }

    public function logout()
    {
        auth()->user()->token()->revoke();
        auth()->user()->token()->delete();
        return response()->json([
            'status' => 'Success',
            'message' => 'You have successfully logged out.'
        ], 200);
    }
}
