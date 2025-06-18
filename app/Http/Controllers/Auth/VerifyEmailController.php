<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VerifyEmailService;
use Illuminate\Support\Facades\Log;

class VerifyEmailController extends Controller
{
    private $service;
    public function __construct(VerifyEmailService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('pages.user.email-verification', ['status' => false]);
    }

    public function verifyEmail(Request $request)
    {
        $result = $this->service->verifyEmail($request->input('email'));
        return view('pages.user.email-verification', ['status' => true]);
    }

    public function sendEmail(Request $request)
    {
        $result = $this->service->sendEmail($request->input('email'));
        
        if (!$result) {
            return response()->json([
                'message' => 'Erro ao enviar o e-mail.'
            ])->setStatusCode(500);
        }
        return response()->json([
            'message' => 'E-mail enviado com sucesso!'
        ])->setStatusCode(200);
    }
}
