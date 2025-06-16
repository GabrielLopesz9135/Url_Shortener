<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }} - Cadastro</title>
    
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
            padding: 20px 0;
        }

        .register-container {
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(26, 54, 93, 0.15);
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            min-height: 700px;
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

        .register-panel {
            flex: 1;
            padding: 50px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            
            overflow-y: auto;
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 30px;
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

        .form-group {
            margin-bottom: 20px;
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

        .btn-register {
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

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 54, 93, 0.3);
            background: linear-gradient(135deg, #2d3748 0%, var(--primary-dark-blue) 100%);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e2e8f0;
            z-index: 1;
        }

        .divider span {
            background: var(--white);
            padding: 0 20px;
            position: relative;
            z-index: 2;
        }

        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .btn-social {
            flex: 1;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            background: var(--white);
            color: var(--text-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-social:hover {
            border-color: var(--accent-green);
            color: var(--accent-green);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .btn-social i {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            color: var(--text-light);
        }

        .login-link a {
            color: var(--primary-dark-blue);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            color: var(--accent-green);
        }

        .form-check-input:checked {
            background-color: var(--accent-green);
            border-color: var(--accent-green);
        }

        .form-check-label {
            color: var(--text-dark);
            font-size: 0.9rem;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .register-container {
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

            .register-panel {
                padding: 40px 30px;
            }

            .social-login {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .welcome-panel {
                padding: 30px 20px;
            }

            .register-panel {
                padding: 30px 20px;
            }

            .brand-logo h1 {
                font-size: 1.7rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="register-container mx-auto">
                    <!-- Welcome Panel -->
                    <div class="welcome-panel">
                        <h2>Junte-se a nós!</h2>
                        <p>Crie sua conta e comece a aproveitar todos os nossos recursos incríveis hoje mesmo.</p>
                        
                        <ul class="welcome-features">
                            <li>
                                <i class="fas fa-rocket"></i>
                                <span>Comece gratuitamente em segundos</span>
                            </li>
                            <li>
                                <i class="fas fa-users"></i>
                                <span>Junte-se a milhares de usuários</span>
                            </li>
                            <li>
                                <i class="fas fa-chart-line"></i>
                                <span>Análises avançadas incluídas</span>
                            </li>
                            <li>
                                <i class="fas fa-headset"></i>
                                <span>Suporte 24/7 disponível</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Register Panel -->
                    <div class="register-panel mt-5">
                        <div class="brand-logo">
                            <h1><i class="fas fa-link" style="color: var(--accent-green);"></i> URLShort</h1>
                            <p>Crie sua conta</p>
                        </div>

                        <!-- Register Form -->
                        <form method="POST" action="{{ route('register') }}" id="registerForm">
                            @csrf
                            
                            <div class="form-group">
                                <label for="name" class="form-label">Nome Completo</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required 
                                       autocomplete="name" 
                                       autofocus
                                       placeholder="Seu nome completo">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autocomplete="email"
                                       placeholder="seu@email.com">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">Senha</label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           required 
                                           autocomplete="new-password"
                                           placeholder="Crie uma senha segura">
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
                                    </ul>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           required 
                                           autocomplete="new-password"
                                           placeholder="Confirme sua senha">
                                    <span class="input-group-text" id="togglePasswordConfirm">
                                        <i class="fas fa-eye" id="eyeIconConfirm"></i>
                                    </span>
                                </div>
                                <div id="passwordMatch" class="mt-2" style="font-size: 0.85rem;"></div>
                            </div>
<!-- 
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="terms" 
                                           id="terms" 
                                           required>
                                    <label class="form-check-label" for="terms">
                                        Aceito os <a href="#" style="color: var(--accent-green);">Termos de Uso</a> e 
                                        <a href="#" style="color: var(--accent-green);">Política de Privacidade</a>
                                    </label>
                                </div>
                            </div> -->

                            <button type="submit" class="btn btn-register">
                                <i class="fas fa-user-plus me-2"></i>
                                Criar Conta
                            </button>
                        </form>

                        <div class="login-link">
                            Já tem uma conta? 
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}">Faça login aqui</a>
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
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
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

        // Toggle password confirmation visibility
        document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
            const passwordConfirm = document.getElementById('password_confirmation');
            const eyeIconConfirm = document.getElementById('eyeIconConfirm');
            
            if (passwordConfirm.type === 'password') {
                passwordConfirm.type = 'text';
                eyeIconConfirm.classList.remove('fa-eye');
                eyeIconConfirm.classList.add('fa-eye-slash');
            } else {
                passwordConfirm.type = 'password';
                eyeIconConfirm.classList.remove('fa-eye-slash');
                eyeIconConfirm.classList.add('fa-eye');
            }
        });

        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthDiv = document.getElementById('passwordStrength');
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /\d/.test(password)
            };

            // Update requirements visual feedback
            Object.keys(requirements).forEach(req => {
                const element = document.getElementById(`req-${req}`);
                if (requirements[req]) {
                    element.classList.add('requirement-met');
                } else {
                    element.classList.remove('requirement-met');
                }
            });

            // Calculate strength
            const metRequirements = Object.values(requirements).filter(Boolean).length;
            let strengthText = '';
            let strengthClass = '';

            if (password.length === 0) {
                strengthText = '';
            } else if (metRequirements < 2) {
                strengthText = 'Senha fraca';
                strengthClass = 'strength-weak';
            } else if (metRequirements < 4) {
                strengthText = 'Senha média';
                strengthClass = 'strength-medium';
            } else {
                strengthText = 'Senha forte';
                strengthClass = 'strength-strong';
            }

            strengthDiv.textContent = strengthText;
            strengthDiv.className = `password-strength ${strengthClass}`;
        });

        // Password confirmation checker
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const passwordConfirm = this.value;
            const matchDiv = document.getElementById('passwordMatch');

            if (passwordConfirm.length === 0) {
                matchDiv.textContent = '';
                return;
            }

            if (password === passwordConfirm) {
                matchDiv.textContent = 'Senhas coincidem ✓';
                matchDiv.style.color = 'var(--accent-green)';
            } else {
                matchDiv.textContent = 'Senhas não coincidem ✗';
                matchDiv.style.color = '#e53e3e';
            }
        });

        // Form validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const passwordConfirm = document.getElementById('password_confirmation').value;
            const terms = document.getElementById('terms').checked;
            
            if (!name || !email || !password || !passwordConfirm) {
                e.preventDefault();
                alert('Por favor, preencha todos os campos obrigatórios.');
                return false;
            }
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert('Por favor, insira um email válido.');
                return false;
            }

            // Password validation
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

            if (!terms) {
                e.preventDefault();
                alert('Você deve aceitar os termos de uso.');
                return false;
            }
        });

        // Add loading state to register button
        document.getElementById('registerForm').addEventListener('submit', function() {
            const submitBtn = this.querySelector('.btn-register');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Criando conta...';
            submitBtn.disabled = true;
        });

        // Add smooth animations
        document.addEventListener('DOMContentLoaded', function() {
            const registerContainer = document.querySelector('.register-container');
            registerContainer.style.opacity = '0';
            registerContainer.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                registerContainer.style.transition = 'all 0.6s ease';
                registerContainer.style.opacity = '1';
                registerContainer.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>

