<?php

namespace App\Services;

use App\Repositories\VerifyEmailRepositoryInterface;
use App\Http\Controllers\EmailController;

class VerifyEmailService {

    private $verifyEmailRepository;
    private $emailController;

    public function __construct(VerifyEmailRepositoryInterface $verifyEmailRepository, EmailController $emailController)
    {
        $this->verifyEmailRepository = $verifyEmailRepository;
        $this->emailController = $emailController;
    }

     public function verifyEmail($email)
    {
        $user = $this->verifyEmailRepository->findUserByEmail($email);
        if(!$user){
            return false;
        }
        $result = $this->verifyEmailRepository->verifyEmail($user);
        return $result;
    }

    public function sendEmail($email)
    {
        $result = $this->emailController->verificationEmail($email);
        return $result;
    }
}