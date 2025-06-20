<?php

namespace App\Services;

use App\Repositories\PasswordRepositoryInterface;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redis;


class PasswordService {

    private $passwordRepository;
    private $emailController;

    public function __construct(PasswordRepositoryInterface $passwordRepository, EmailController $emailController)
    {
        $this->passwordRepository = $passwordRepository;
        $this->emailController = $emailController;
    }

    public function sendEmail($email)
    {

        if (Redis::exists("passwordreset:{$email}")) {
            return [
                'message' => 'Você já enviou um e-mail nos últimos 60 segundos.',
                'status' => false,
            ];
        } 
        Redis::setex("passwordreset:{$email}", 80, 'teste');
        
        $userExists = $this->passwordRepository->findUserByEmail($email);

        if (!$userExists) {
            return $data = ['message' => 'Usuário não encontrado.','status' => false];
        }

        return ['message' => 'teste','status' => true];

        $result = $this->emailController->passwordResetEmail($email);
        return $result;
    }
    
    public function resetPassword($data)
    {
        try {
            $decryptedToken = Crypt::decryptString($data['token']);
            $decryptedExpireAt = Crypt::decryptString($data->query('expires_at'));

            if (Carbon::now()->greaterThan(Carbon::parse($decryptedExpireAt))) {
                return $data = ['message' => 'Link expirado.','status' => false];
            }

            if($decryptedToken != $data['email']){
                return $data = ['message' => 'Token inválido ou corrompido.','status' => false];
            }

            $this->passwordRepository->updatePassword($data['email'], $data['password']);

            return $data = ['message' => 'Email verificado com Sucesso.','status' => true];
        } catch (DecryptException $e) {
            return $data = ['message' => 'Token inválido ou corrompido.','status' => false];
        }

    }
}