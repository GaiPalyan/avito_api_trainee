<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\UserRepositoryInterface;
use App\Http\Requests\User\RegisterData;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function save(RegisterData $authData): array
    {
        $user = User::create([
            'name' => $authData->getName(),
            'email' => $authData->getEmail(),
            'password' => $authData->getHash(),
        ]);
        $token = $this->saveToken($user);

        return compact('user', 'token');
    }

    public function saveToken(User $user): string
    {
        return $user->createToken('avito_token')->plainTextToken;
    }

    public function getUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function deleteToken(User $user): void
    {
        $user->tokens()->delete();
    }
}
