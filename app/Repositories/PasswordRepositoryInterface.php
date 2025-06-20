<?php

namespace App\Repositories;

use App\Models\User;

interface PasswordRepositoryInterface
{

    public function __construct(User $data);

    public function updatePassword(string $email, string $password): bool;
    public function findUserByEmail(string $email): bool;
}