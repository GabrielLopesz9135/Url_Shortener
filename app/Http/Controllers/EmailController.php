<?php

namespace App\Http\Controllers;

use App\Mail\UserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    public function enviarEmailDeTeste($email)
    {
        $destinatario = $email; 
        $dadosParaEmail = 'Alguns dados importantes.';

        try {
            Mail::to($destinatario)->send(new UserMail($dadosParaEmail));
            return "E-mail de teste enviado com sucesso para " . $destinatario;
        } catch (\Exception $e) {
            return "Erro ao enviar e-mail: " . $e->getMessage();
        }
    }

    public function verificationEmail($email)
    {
        $receiver = $email; 
        $encryptedEmail = Crypt::encryptString($receiver);
        $expireAt = now()->addMinutes(60)->toDateTimeString();
        $encryptedExpireAt = Crypt::encryptString($expireAt);
        $link = url('/verify-email?token=' . urlencode($encryptedEmail) . '&expires_at=' . urlencode($encryptedExpireAt));

        $dateToEmail = [
            'subject' => 'Verificação de E-mail',
            'view' => 'emails.email-verification-template',
            'link' => $link,
            'name' => Auth::user()->name ?? 'Usuário',
            'user' => $receiver,
        ];

        try {
            Mail::to($receiver)->send(new UserMail($dateToEmail));
            return $data = ['message' => "E-mail enviado com sucesso para " . $receiver,'status' => true];
        } catch (\Exception $e) {
            return $data = ['message' => "Erro ao enviar e-mail: " . $e->getMessage(),'status' => false];
        }
    }

    public function passwordResetEmail($email)
    {
        $receiver = $email; 
        $encryptedEmail = Crypt::encryptString($receiver);
        $expireAt = now()->addMinutes(60)->toDateTimeString();
        $encryptedExpireAt = Crypt::encryptString($expireAt);
        $link = url('/'.'reset-password'.'/' . urlencode($encryptedEmail) .'?email=' . $receiver . '&expires_at=' . urlencode($encryptedExpireAt));

        $dateToEmail = [
            'subject' => 'Redefinição de Senha',
            'view' => 'emails.email-password-reset-template',
            'link' => $link,
            'name' => Auth::user()->name ?? 'Usuário',
            'user' => $receiver,
        ];

        try {
            Mail::to($receiver)->send(new UserMail($dateToEmail));
            return $data = ['message' => "E-mail enviado com sucesso para " . $receiver,'status' => true];
        } catch (\Exception $e) {
            return $data = ['message' => "Erro ao enviar e-mail: " . $e->getMessage(),'status' => false];
        }
    }
}
