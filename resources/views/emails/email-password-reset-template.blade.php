<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redefinir Senha - {{ config('app.name', 'LinkApp') }}</title>
    
    <style>
        /* Reset CSS para compatibilidade com clientes de e-mail */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        /* Container principal */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(26, 54, 93, 0.1);
        }

        /* Header do e-mail */
        .email-header {
            background: linear-gradient(135deg, #1a365d 0%, #2d3748 100%);
            padding: 40px 30px;
            text-align: center;
            color: #ffffff;
            position: relative;
        }

        .email-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(214, 158, 46, 0.2) 0%, transparent 70%);
            opacity: 0.3;
        }

        .logo {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }

        .logo i {
            color: #38a169;
            margin-right: 8px;
        }

        .header-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        /* Ícone principal */
        .main-icon {
            width: 80px;
            height: 80px;
            background: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 30px auto 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
        }

        .main-icon i {
            font-size: 2rem;
            color: #d69e2e;
        }

        /* Conteúdo do e-mail */
        .email-content {
            padding: 40px 30px;
            text-align: center;
        }

        .email-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #1a365d;
            margin-bottom: 15px;
        }

        .email-message {
            font-size: 1rem;
            color: #718096;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .user-email {
            background: rgba(26, 54, 93, 0.1);
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 600;
            color: #1a365d;
        }

        /* Botão principal */
        .reset-button {
            display: inline-block;
            background: linear-gradient(135deg, #d69e2e 0%, #b7791f 100%);
            color: #ffffff;
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            margin: 20px 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(214, 158, 46, 0.2);
        }

        .reset-button:hover {
            background: linear-gradient(135deg, #b7791f 0%, #d69e2e 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(214, 158, 46, 0.3);
            color: #ffffff;
            text-decoration: none;
        }

        /* Seção de instruções */
        .instructions {
            background: #f8fafc;
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
            border-left: 4px solid #d69e2e;
        }

        .instructions h4 {
            color: #2d3748;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .instructions h4 i {
            margin-right: 8px;
            color: #d69e2e;
        }

        .instructions ol {
            text-align: left;
            color: #718096;
            font-size: 0.9rem;
            padding-left: 20px;
        }

        .instructions li {
            margin-bottom: 8px;
            line-height: 1.4;
        }

        /* Link alternativo */
        .alternative-link {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
            font-size: 0.85rem;
            color: #718096;
        }

        .alternative-link strong {
            color: #2d3748;
        }

        .alternative-link a {
            color: #d69e2e;
            word-break: break-all;
        }

        /* Informações de segurança */
        .security-info {
            background: rgba(229, 62, 62, 0.1);
            border: 1px solid #e53e3e;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }

        .security-info h5 {
            color: #2d3748;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .security-info h5 i {
            margin-right: 8px;
            color: #e53e3e;
        }

        .security-info p {
            font-size: 0.9rem;
            color: #718096;
            margin: 0;
        }

        /* Informações adicionais */
        .additional-info {
            background: rgba(56, 161, 105, 0.1);
            border: 1px solid #38a169;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }

        .additional-info h5 {
            color: #2d3748;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .additional-info h5 i {
            margin-right: 8px;
            color: #38a169;
        }

        .additional-info p {
            font-size: 0.9rem;
            color: #718096;
            margin: 0;
        }

        /* Footer do e-mail */
        .email-footer {
            background: #2d3748;
            color: #ffffff;
            padding: 30px;
            text-align: center;
            font-size: 0.85rem;
        }

        .footer-links {
            margin-bottom: 20px;
        }

        .footer-links a {
            color: #38a169;
            text-decoration: none;
            margin: 0 15px;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        .footer-text {
            color: #a0aec0;
            line-height: 1.5;
        }

        .footer-text strong {
            color: #ffffff;
        }

        /* Responsividade */
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 8px;
            }

            .email-header {
                padding: 30px 20px;
            }

            .email-content {
                padding: 30px 20px;
            }

            .email-title {
                font-size: 1.5rem;
            }

            .reset-button {
                padding: 12px 30px;
                font-size: 0.95rem;
            }

            .instructions {
                padding: 20px;
            }

            .email-footer {
                padding: 25px 20px;
            }

            .footer-links a {
                display: block;
                margin: 5px 0;
            }
        }

        /* Compatibilidade com clientes de e-mail */
        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="logo">
                <i class="fas fa-link"></i>{{ config('app.name', 'LinkApp') }}
            </div>
            <div class="header-subtitle">Redefinição de Senha</div>
            
            <div class="main-icon">
                <i class="fas fa-key"></i>
            </div>
        </div>

        <!-- Conteúdo Principal -->
        <div class="email-content">
            <h1 class="email-title">Redefinir sua Senha</h1>
            
            <p class="email-message">
                Olá <strong>{{ $user->name ?? 'Usuário' }}</strong>!<br><br>
                Recebemos uma solicitação para redefinir a senha da sua conta associada ao e-mail 
                <span class="user-email">{{ $user->email ?? 'seu@email.com' }}</span>. 
                Se você fez esta solicitação, clique no botão abaixo para criar uma nova senha.
            </p>

            <!-- Botão Principal -->
            <a href="{{ $resetUrl ?? '#' }}" class="reset-button">
                <i class="fas fa-lock" style="margin-right: 8px;"></i>
                Redefinir Senha
            </a>

            <!-- Instruções -->
            <div class="instructions">
                <h4><i class="fas fa-list-ol"></i>Como proceder:</h4>
                <ol>
                    <li>Clique no botão "Redefinir Senha" acima</li>
                    <li>Você será direcionado para uma página segura</li>
                    <li>Digite sua nova senha (mínimo 8 caracteres)</li>
                    <li>Confirme a nova senha e salve as alterações</li>
                    <li>Faça login com suas novas credenciais</li>
                </ol>
            </div>

            <!-- Link Alternativo -->
            <div class="alternative-link">
                <strong>Problemas com o botão?</strong><br>
                Copie e cole este link no seu navegador:<br>
                <a href="{{ $resetUrl ?? '#' }}">{{ $resetUrl ?? 'https://exemplo.com/reset' }}</a>
            </div>

            <!-- Informações de Segurança -->
            <div class="security-info">
                <h5><i class="fas fa-exclamation-triangle"></i>Importante - Segurança</h5>
                <p>
                    Este link de redefinição expira em <strong>60 minutos</strong> por motivos de segurança. 
                    Se você não solicitou esta redefinição, ignore este e-mail e sua senha permanecerá inalterada.
                </p>
            </div>

            <!-- Informações Adicionais -->
            <div class="additional-info">
                <h5><i class="fas fa-info-circle"></i>Não solicitou esta alteração?</h5>
                <p>
                    Se você não solicitou a redefinição de senha, recomendamos que verifique a segurança da sua conta. 
                    Entre em contato conosco imediatamente se suspeitar de atividade não autorizada.
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <div class="footer-links">
                <a href="{{ config('app.url') }}">Página Inicial</a>
                <a href="{{ config('app.url') }}/support">Suporte</a>
                <a href="{{ config('app.url') }}/security">Segurança</a>
            </div>
            
            <div class="footer-text">
                <strong>{{ config('app.name', 'LinkApp') }}</strong><br>
                Este e-mail foi enviado automaticamente. Por favor, não responda a esta mensagem.<br>
                Se você tem dúvidas sobre segurança, entre em contato conosco imediatamente.
            </div>
        </div>
    </div>
</body>
</html>

