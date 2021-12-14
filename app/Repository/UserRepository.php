<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\UserRepositoryInterface;
use App\Http\Requests\User\RegisterData;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function save(RegisterData $authData): User
    {
        return User::create([
            'name' => $authData->getName(),
            'email' => $authData->getEmail(),
            'password' => $authData->getHash(),
        ]);
    }

    public function saveToken(User $user): string
    {
        return $user->createToken('avito_token')->plainTextToken;
    }

    public function getUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function deleteTokens(User $user): void
    {
        $user->tokens()->delete();
    }
}
