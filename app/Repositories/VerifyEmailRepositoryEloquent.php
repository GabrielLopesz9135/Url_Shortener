<?php

namespace App\Repositories;
use App\Models\User;

class VerifyEmailRepositoryEloquent implements VerifyEmailRepositoryInterface
{
    private $model;

    public function __construct(User $data)
    {
        $this->model = $data;
    }

    public function verifyEmail($user)
    {
        if(!$user->email_verified_at){
            return $user->markEmailAsVerified();
        }
        return true;
        
    }

    public function findUserByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

}