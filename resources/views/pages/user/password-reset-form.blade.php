<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }} - Nova Senha</title>
    
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
            background: linear-gradient(135deg, var(--accent-yellow) 0%, #ecc94b 100%);
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
            background: radial-gradient(circle, var(--accent-green) 0%, transparent 70%);
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .security-icon {
            width: 120px;
            height: 120px;
            background: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            position: relative;
            z-index: 2;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .security-icon i {
            font-size: 3rem;
            color: var(--accent-yellow);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
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
            color: var(--primary-dark-blue);
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

        .reset-status {
            background: rgba(214, 158, 46, 0.1);
            border: 2px solid var(--accent-yellow);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            text-align: center;
        }

        .success-status {
            background: rgba(56, 161, 105, 0.1);
            border: 2px solid var(--accent-yellow);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            text-align: center;
        }

        .status-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            display: block;
            color: var(--accent-yellow);
        }

        .status-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .status-message {
            color: var(--text-light);
            font-size: 0.95rem;
            margin: 0;
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
            border-color: var(--accent-yellow);
            box-shadow: 0 0 0 3px rgba(214, 158, 46, 0.1);
            background-color: var(--white);
        }

        .input-group {
            position: relative;
        }

        .input-group-text {
            background: transparent;
            border: none;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            cursor: pointer;
            color: var(--text-light);
        }

        .btn-reset {
            background: linear-gradient(135deg, var(--accent-yellow) 0%, #ecc94b 100%);
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-size: 1rem;
            font-weight: 600;
            color: var(--primary-dark-blue);
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(214, 158, 46, 0.3);
            background: linear-gradient(135deg, #ecc94b 0%, var(--accent-yellow) 100%);
            color: var(--primary-dark-blue);
        }

        .password-strength {
            margin-top: 8px;
            font-size: 0.85rem;
        }

        .strength-weak { color: #e53e3e; }
        .strength-medium { color: var(--accent-yellow); }
        .strength-strong { color: var(--accent-green); }

        .password-requirements {
            margin-top: 8px;
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .password-requirements ul {
            margin: 0;
            padding-left: 15px;
        }

        .password-requirements li {
            margin-bottom: 2px;
        }

        .requirement-met {
            color: var(--accent-green);
        }

        .password-match {
            margin-top: 8px;
            font-size: 0.85rem;
        }

        .match-success { color: var(--accent-green); }
        .match-error { color: #e53e3e; }

        .security-tips {
            background: rgba(56, 161, 105, 0.1);
            border: 1px solid var(--accent-green);
            border-radius: 12px;
            padding: 20px;
            margin-top: 25px;
        }

        .security-tips h5 {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }

        .security-tips h5 i {
            margin-right: 8px;
            color: var(--accent-green);
        }

        .security-tips ul {
            margin: 0;
            padding-left: 20px;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .security-tips li {
            margin-bottom: 5px;
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

        .error-message {
            background: rgba(229, 62, 62, 0.1);
            border: 1px solid #e53e3e;
            color: #e53e3e;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 25px;
            font-size: 0.9rem;
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

            .security-icon {
                width: 100px;
                height: 100px;
            }

            .security-icon i {
                font-size: 2.5rem;
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
                        <div class="security-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h2>Quase Pronto!</h2>
                        <p>Agora você pode criar uma nova senha segura para sua conta. Escolha uma senha forte para manter seus dados protegidos.</p>
                        
                        <ul class="welcome-features">
                            <li>
                                <i class="fas fa-lock"></i>
                                <span>Criptografia avançada</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Processo seguro</span>
                            </li>
                            <li>
                                <i class="fas fa-user-shield"></i>
                                <span>Dados protegidos</span>
                            </li>
                            <li>
                                <i class="fas fa-key"></i>
                                <span>Acesso renovado</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Reset Panel -->
                    <div class="reset-panel">
                        <div class="brand-logo">
                            <h1><i class="fas fa-link" style="color: var(--accent-green);"></i>URLShort</h1>
                            <p>Criar nova senha</p>
                        </div>

                       
                        @php
                            $status = $status ?? false;
                        @endphp

                         @if(!$status)

                         <!-- Reset Status -->
                        <div class="reset-status">
                            <i class="fas fa-key status-icon"></i>
                            <h3 class="status-title">Redefinir Senha</h3>
                            <p class="status-message">Digite sua nova senha nos campos abaixo</p>
                        </div>

                        <!-- Reset Form -->
                            <form method="POST" action="{{ route('password.reset') }}" id="passwordResetForm">
                                @csrf
                                
                                <input type="hidden" name="token" value="{{ $request['token'] ?? '' }}">
                                <input type="hidden" name="email" value="{{ $request->email ?? old('email') }}">
                                <input type="hidden" name="expires_at" value="{{ $request->expires_at ?? old('expires_at') }}">
                                
                                <div class="form-group">
                                    <label for="password" class="form-label">Nova Senha</label>
                                    <div class="input-group">
                                        <input type="password" 
                                            class="form-control @error('password') is-invalid @enderror" 
                                            id="password" 
                                            name="password" 
                                            required 
                                            autocomplete="new-password"
                                            placeholder="Digite sua nova senha">
                                        <span class="input-group-text" id="togglePassword">
                                            <i class="fas fa-eye" id="eyeIcon"></i>
                                        </span>
                                    </div>
                                    <div class="password-strength" id="passwordStrength"></div>
                                    <div class="password-requirements">
                                        <ul id="passwordRequirements">
                                            <li id="req-length">Mínimo de 8 caracteres</li>
                                            <li id="req-uppercase">Uma letra maiúscula</li>
                                            <li id="req-lowercase">Uma letra minúscula</li>
                                            <li id="req-number">Um número</li>
                                            <li id="req-special">Um caractere especial</li>
                                        </ul>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
                                    <div class="input-group">
                                        <input type="password" 
                                            class="form-control" 
                                            id="password_confirmation" 
                                            name="password_confirmation" 
                                            required 
                                            autocomplete="new-password"
                                            placeholder="Confirme sua nova senha">
                                        <span class="input-group-text" id="togglePasswordConfirm">
                                            <i class="fas fa-eye" id="eyeIconConfirm"></i>
                                        </span>
                                    </div>
                                    <div class="password-match" id="passwordMatch"></div>
                                </div>

                                <button type="submit" class="btn btn-reset">
                                    <i class="fas fa-save me-2"></i>
                                    Salvar Nova Senha
                                </button>
                            </form>
                            
                        @elseif($status == true)
                            <div class="success-message">
                                <i class="fas fa-key status-icon"></i>
                                <h3 class="status-title">Senha Redefinida com Sucesso</h3>
                                <a href="{{ route('login') }}" class="btn">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                    Ir para Página de Login
                                </a>
                            </div>
                        @endif

<!--                         @if ($errors->any())
                            <div class="error-message">
                                <strong>Erro:</strong>
                                <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif -->

                        <!-- Security Tips -->
                        <div class="security-tips">
                            <h5><i class="fas fa-lightbulb"></i>Dicas de Segurança</h5>
                            <ul>
                                <li>Use uma combinação de letras, números e símbolos</li>
                                <li>Evite informações pessoais como nome ou data de nascimento</li>
                                <li>Não reutilize senhas de outras contas</li>
                                <li>Considere usar um gerenciador de senhas</li>
                            </ul>
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
        // Toggle password visibility functions
        function setupPasswordToggle(toggleId, passwordId, iconId) {
            document.getElementById(toggleId).addEventListener('click', function() {
                const password = document.getElementById(passwordId);
                const eyeIcon = document.getElementById(iconId);
                
                if (password.type === 'password') {
                    password.type = 'text';
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    password.type = 'password';
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            });
        }

        // Setup password toggles
        setupPasswordToggle('togglePassword', 'password', 'eyeIcon');
        setupPasswordToggle('togglePasswordConfirm', 'password_confirmation', 'eyeIconConfirm');


        // Password confirmation checker
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const passwordConfirm = this.value;
            const matchDiv = document.getElementById('passwordMatch');

            if (passwordConfirm.length === 0) {
                matchDiv.textContent = '';
                matchDiv.className = 'password-match';
                return;
            }

            if (password === passwordConfirm) {
                matchDiv.textContent = 'Senhas coincidem ✓';
                matchDiv.className = 'password-match match-success';
            } else {
                matchDiv.textContent = 'Senhas não coincidem ✗';
                matchDiv.className = 'password-match match-error';
            }
        });

        // Form validation
        document.getElementById('passwordResetForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const passwordConfirm = document.getElementById('password_confirmation').value;
            
            if (!password || !passwordConfirm) {
                e.preventDefault();
                alert('Por favor, preencha todos os campos de senha.');
                return false;
            }

            if (password.length < 8) {
                e.preventDefault();
                alert('A senha deve ter pelo menos 8 caracteres.');
                return false;
            }

            if (password !== passwordConfirm) {
                e.preventDefault();
                alert('As senhas não coincidem.');
                return false;
            }
        });

        // Add loading state to submit button
        document.getElementById('passwordResetForm').addEventListener('submit', function() {
            const submitBtn = this.querySelector('.btn-reset');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Salvando...';
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

        // Auto-focus password input
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('password').focus();
        });
    </script>
</body>
</html>

