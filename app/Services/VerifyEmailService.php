<?php

namespace App\Services;

use App\Repositories\VerifyEmailRepositoryInterface;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Carbon;

class VerifyEmailService {

    private $verifyEmailRepository;
    private $emailController;

    public function __construct(VerifyEmailRepositoryInterface $verifyEmailRepository, EmailController $emailController)
    {
        $this->verifyEmailRepository = $verifyEmailRepository;
        $this->emailController = $emailController;
    }

    public function index($email)
    {
        $user = $this->verifyEmailRepository->findUserByEmail($email);
        if ($user->hasVerifiedEmail()) {
                return $data = ['message' => 'E-mail já verificado.','status' => true];
        }
        return $data = ['message' => 'E-mail não verificado.','status' => 'first'];
    }

     public function verifyEmail($data)
    {
        try {
            $decryptedEmail = Crypt::decryptString($data->query('token'));
            $decryptedExpireAt = Crypt::decryptString($data->query('expires_at'));

            if (Carbon::now()->greaterThan(Carbon::parse($decryptedExpireAt))) {
                return $data = ['message' => 'Link expirado.','status' => false];
            }

            $user = $this->verifyEmailRepository->findUserByEmail($decryptedEmail);

            if(!$user){
                return $data = ['message' => 'Usuário não encontrado.','status' => false];
            }

            if ($user->hasVerifiedEmail()) {
                return $data = ['message' => 'E-mail já verificado.','status' => true];
            }

            $result = $this->verifyEmailRepository->verifyEmail($user);

            return $data = ['message' => 'Email verificado com Sucesso.','status' => true];
        } catch (DecryptException $e) {
            return $data = ['message' => 'Token inválido ou corrompido.','status' => false];
        }
    }

    public function sendEmail($email)
    {
        $result = $this->emailController->verificationEmail($email);
        return $result;
    }
}