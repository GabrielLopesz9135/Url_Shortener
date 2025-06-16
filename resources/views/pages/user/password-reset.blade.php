<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }} - Recuperar Senha</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-dark-blue: #1a365d;
            --secondary-blue: #2d3748;
            --accent-green: #38a169;
            --accent-yellow: #d69e2e;
            --light-gray: #f7fafc;
            --white: #ffffff;
            --text-dark: #2d3748;
            --text-light: #718096;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--primary-dark-blue) 0%, var(--secondary-blue) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .reset-container {
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(26, 54, 93, 0.15);
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            display: flex;
        }

        .welcome-panel {
            background: linear-gradient(135deg, var(--accent-green) 0%, #48bb78 100%);
            flex: 1;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .welcome-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, var(--accent-yellow) 0%, transparent 70%);
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .welcome-panel h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            z-index: 2;
            position: relative;
        }

        .welcome-panel p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
            z-index: 2;
            position: relative;
            line-height: 1.6;
        }

        .welcome-features {
            list-style: none;
            z-index: 2;
            position: relative;
        }

        .welcome-features li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .welcome-features li i {
            margin-right: 12px;
            color: var(--accent-yellow);
            font-size: 1.2rem;
        }

        .reset-panel {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .brand-logo h1 {
            color: var(--primary-dark-blue);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .brand-logo p {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .reset-steps {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 4px solid var(--accent-green);
        }

        .reset-steps h4 {
            color: var(--text-dark);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .reset-steps ol {
            margin: 0;
            padding-left: 20px;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .reset-steps li {
            margin-bottom: 5px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px 18px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .form-control:focus {
            border-color: var(--accent-green);
            box-shadow: 0 0 0 3px rgba(56, 161, 105, 0.1);
            background-color: var(--white);
        }

        .btn-reset {
            background: linear-gradient(135deg, var(--primary-dark-blue) 0%, var(--secondary-blue) 100%);
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-size: 1rem;
            font-weight: 600;
            color: var(--white);
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 54, 93, 0.3);
            background: linear-gradient(135deg, #2d3748 0%, var(--primary-dark-blue) 100%);
        }

        .back-to-login {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
        }

        .back-to-login a {
            color: var(--accent-green);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
        }

        .back-to-login a:hover {
            text-decoration: underline;
        }

        .back-to-login a i {
            margin-right: 8px;
        }

        .success-message {
            background: rgba(56, 161, 105, 0.1);
            border: 1px solid var(--accent-green);
            color: var(--accent-green);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            text-align: center;
        }

        .success-message i {
            font-size: 2rem;
            margin-bottom: 10px;
            display: block;
        }

        .success-message h4 {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .success-message p {
            margin: 0;
            font-size: 0.9rem;
        }

        .email-highlight {
            background: rgba(56, 161, 105, 0.1);
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 600;
            color: var(--accent-green);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .reset-container {
                flex-direction: column;
                margin: 20px;
                border-radius: 15px;
            }

            .welcome-panel {
                padding: 40px 30px;
                min-height: 300px;
            }

            .welcome-panel h2 {
                font-size: 2rem;
            }

            .reset-panel {
                padding: 40px 30px;
            }
        }

        @media (max-width: 480px) {
            .welcome-panel {
                padding: 30px 20px;
            }

            .reset-panel {
                padding: 30px 20px;
            }

            .brand-logo h1 {
                font-size: 1.7rem;
            }
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="reset-container mx-auto">
                    <!-- Welcome Panel -->
                    <div class="welcome-panel">
                        <h2>Esqueceu sua senha?</h2>
                        <p>Não se preocupe! Isso acontece com todos nós. Vamos ajudá-lo a recuperar o acesso à sua conta rapidamente.</p>
                        
                        <ul class="welcome-features">
                            <li>
                                <i class="fas fa-shield-alt"></i>
                                <span>Processo 100% seguro</span>
                            </li>
                            <li>
                                <i class="fas fa-clock"></i>
                                <span>Recuperação em minutos</span>
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <span>Link enviado por email</span>
                            </li>
                            <li>
                                <i class="fas fa-key"></i>
                                <span>Nova senha personalizada</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Reset Panel -->
                    <div class="reset-panel">
                        <div class="brand-logo">
                            <h1><i class="fas fa-link" style="color: var(--accent-green);"></i> {{ config('app.name', 'LinkApp') }}</h1>
                            <p>Recuperação de senha</p>
                        </div>

                        <!-- Reset Form -->
                        <div id="resetForm">
                            <div class="reset-steps">
                                <h4><i class="fas fa-info-circle" style="color: var(--accent-green); margin-right: 8px;"></i>Como funciona:</h4>
                                <ol>
                                    <li>Digite seu email cadastrado</li>
                                    <li>Verifique sua caixa de entrada</li>
                                    <li>Clique no link recebido</li>
                                    <li>Crie uma nova senha</li>
                                </ol>
                            </div>

                            @if (session('status'))
                                <div class="success-message">
                                    <i class="fas fa-check-circle"></i>
                                    <h4>Email enviado com sucesso!</h4>
                                    <p>{{ session('status') }}</p>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}" id="passwordResetForm">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required 
                                           autocomplete="email" 
                                           autofocus
                                           placeholder="Digite seu email cadastrado">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-reset">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Enviar Link de Recuperação
                                </button>
                            </form>
                        </div>

                        <!-- Success Message (Hidden by default) -->
                        <div id="successMessage" class="hidden">
                            <div class="success-message">
                                <i class="fas fa-check-circle"></i>
                                <h4>Email enviado com sucesso!</h4>
                                <p>Enviamos um link de recuperação para <span class="email-highlight" id="sentEmail"></span></p>
                                <p style="margin-top: 10px; font-size: 0.85rem;">
                                    Verifique sua caixa de entrada e spam. O link expira em 60 minutos.
                                </p>
                            </div>

                            <div class="reset-steps">
                                <h4><i class="fas fa-clock" style="color: var(--accent-yellow); margin-right: 8px;"></i>Próximos passos:</h4>
                                <ol>
                                    <li>Abra seu email e procure nossa mensagem</li>
                                    <li>Clique no botão "Redefinir Senha"</li>
                                    <li>Crie uma nova senha segura</li>
                                    <li>Faça login com suas novas credenciais</li>
                                </ol>
                            </div>

                            <button type="button" class="btn btn-reset" onclick="resendEmail()">
                                <i class="fas fa-redo me-2"></i>
                                Reenviar Email
                            </button>
                        </div>

                        <div class="back-to-login">
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}">
                                    <i class="fas fa-arrow-left"></i>
                                    Voltar para o login
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Form validation
        document.getElementById('passwordResetForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            
            if (!email) {
                e.preventDefault();
                alert('Por favor, digite seu email.');
                return false;
            }
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert('Por favor, insira um email válido.');
                return false;
            }

            // Show success message (for demo purposes)
            // In real implementation, this would be handled by Laravel
            e.preventDefault();
            showSuccessMessage(email);
        });

        // Show success message
        function showSuccessMessage(email) {
            document.getElementById('resetForm').classList.add('hidden');
            document.getElementById('successMessage').classList.remove('hidden');
            document.getElementById('sentEmail').textContent = email;
        }

        // Resend email function
        function resendEmail() {
            const email = document.getElementById('email').value;
            
            // Add loading state
            const resendBtn = document.querySelector('#successMessage .btn-reset');
            const originalText = resendBtn.innerHTML;
            resendBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Reenviando...';
            resendBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                alert('Email reenviado com sucesso!');
                resendBtn.innerHTML = originalText;
                resendBtn.disabled = false;
            }, 2000);
        }

        // Add loading state to reset button
        document.getElementById('passwordResetForm').addEventListener('submit', function() {
            const submitBtn = this.querySelector('.btn-reset');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enviando...';
            submitBtn.disabled = true;
        });

        // Add smooth animations
        document.addEventListener('DOMContentLoaded', function() {
            const resetContainer = document.querySelector('.reset-container');
            resetContainer.style.opacity = '0';
            resetContainer.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                resetContainer.style.transition = 'all 0.6s ease';
                resetContainer.style.opacity = '1';
                resetContainer.style.transform = 'translateY(0)';
            }, 100);
        });

        // Auto-focus email input
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').focus();
        });

        // Handle Enter key in email field
        document.getElementById('email').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('passwordResetForm').dispatchEvent(new Event('submit'));
            }
        });
    </script>
</body>
</html>

