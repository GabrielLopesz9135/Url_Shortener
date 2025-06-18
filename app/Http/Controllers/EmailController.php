<?php

namespace App\Http\Controllers;

use App\Mail\UserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

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
        $dateToEmail = [
            'subject' => 'Verificação de E-mail',
            'view' => 'emails.email-verification-template',
            'link' => url('/verify-email?email=' . $receiver),
            'name' => Auth::user()->name ?? 'Usuário',
            'user' => $receiver,
        ];

        try {
            Mail::to($receiver)->send(new UserMail($dateToEmail));
            return "E-mail de teste enviado com sucesso para " . $receiver;
        } catch (\Exception $e) {
            return "Erro ao enviar e-mail: " . $e->getMessage();
        }
    }
}
