<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\UserManager;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private UserManager $manager;
    public function __construct(UserManager $manager)
    {
        $this->manager = $manager;
    }

    public function register(RegisterRequest $request): Response
    {
        $response = $this->manager->store($request->getInputData());
        return response($response->toArray(), 201);
    }

    public function logIn(LoginRequest $request): Response
    {
        $user = $this->manager->getUser($request->input('email'));

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response(['message' => 'Wrong credentials'], 401);
        }

        $this->manager->terminateAccess($user);
        $token = $this->manager->getNewToken($user);
        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function logOut(Request $request): JsonResponse
    {
        if (auth()->check()) {
            $this->manager->terminateAccess($request->user());
        }

        return response()->json('Logged out');
    }
}
