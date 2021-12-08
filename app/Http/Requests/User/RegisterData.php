<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

class RegisterData
{
    private string $name;
    private string $email;
    private string $password;
    private string $hashed_password;

    public function __construct(string $name, string $email, string $password, string $hashed_password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->hashed_password = $hashed_password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return  $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getHash(): string
    {
        return $this->hashed_password;
    }
}