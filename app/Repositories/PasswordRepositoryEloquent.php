<?php

namespace App\Repositories;
use App\Models\User;

class PasswordRepositoryEloquent implements PasswordRepositoryInterface
{
    private $model;

    public function __construct(User $data)
    {
        $this->model = $data;
    }

    public function findUserByEmail(string $email): bool
    {
        return $this->model->where('email', $email)->exists();
    }

    public function updatePassword(string $email, string $password): bool
    {
        $user = $this->model->where('email', $email)->first();

        if (!$user) {
            return false;
        }

        $user->password = bcrypt($password);
        return $user->save();
    }
}