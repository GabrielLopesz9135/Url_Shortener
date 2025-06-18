<?php

namespace App\Repositories;

use App\Models\User;

interface VerifyEmailRepositoryInterface
{

    public function __construct(User $data);

    public function verifyEmail($user);
    public function findUserByEmail($email);
}