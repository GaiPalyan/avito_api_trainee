<?php

declare(strict_types=1);

namespace App\Domain;

use App\Http\Requests\User\RegisterData;
use App\Models\User;

class UserManager
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store(RegisterData $authData): array
    {
        return $this->repository->save($authData);
    }

    public function getUser(string $param): ?User
    {
        return $this->repository->getUserByEmail($param);
    }

    public function getNewToken(User $user): string
    {
        return $this->repository->saveToken($user);
    }

    public function terminateAccess(User $user): void
    {
        $this->repository->deleteToken($user);
    }
}