<?php

declare(strict_types=1);

namespace App\Domain;

use App\Http\Requests\User\RegisterData;
use App\Models\User;

interface UserRepositoryInterface
{
    public function save(RegisterData $authData): array;
    public function getUserByEmail(string $email): ?User;
    public function saveToken(User $user): string;
    public function deleteToken(User $user): void;
}