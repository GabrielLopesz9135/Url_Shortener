<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }} - Editar Perfil</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #3b82f6;
            --accent-color: #f59e0b;
            --dark-bg: #0f172a;
            --light-bg: #f8fafc;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, var(--primary-color) 0%,var(--secondary-color) 100%);
            color: var(--text-dark);
            line-height: 1.6;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid #e2e8f0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
        }

        .navbar-nav .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--primary-color) !important;
        }

        .profile-container {
            background: var(--light-bg);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(26, 54, 93, 0.15);
            overflow: hidden;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            min-height: 600px;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--success-color) 0%, #48bb78 100%);
            padding: 40px;
            text-align: center;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, var(--success-color) 0%, transparent 70%);
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            position: relative;
            z-index: 2;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .profile-avatar i {
            font-size: 3rem;
            color: var(--accent-green);
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .avatar-upload {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 35px;
            height: 35px;
            background: var(--accent-yellow);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 3px solid var(--white);
        }

        .avatar-upload:hover {
            background: #b7791f;
            transform: scale(1.1);
        }

        .avatar-upload i {
            color: var(--white);
            font-size: 0.9rem;
        }

        .profile-header h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            z-index: 2;
            position: relative;
        }

        .profile-header p {
            font-size: 1rem;
            opacity: 0.9;
            z-index: 2;
            position: relative;
        }

        .profile-content {
            padding: 50px;
        }

        .section-title {
            color: var(--primary-dark-blue);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 12px;
            color: var(--accent-green);
        }

        .form-section {
            margin-bottom: 40px;
            padding: 30px;
            background: #f8fafc;
            border-radius: 15px;
            border: 1px solid #e2e8f0;
        }

        .form-section h3 {
            color: var(--text-dark);
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .form-section h3 i {
            margin-right: 10px;
            color: var(--accent-green);
            font-size: 1rem;
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
            background-color: var(--white);
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

        .btn-update {
            background: linear-gradient(135deg, var(--primary-dark-blue) 0%, var(--secondary-blue) 100%);
            border: none;
            border-radius: 12px;
            padding: 15px 30px;
            font-size: 1rem;
            font-weight: 600;
            color: var(--white);
            transition: all 0.3s ease;
            margin-right: 15px;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 54, 93, 0.3);
            background: linear-gradient(135deg, #2d3748 0%, var(--primary-dark-blue) 100%);
        }

        .btn-cancel {
            background: transparent;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px 30px;
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-cancel:hover {
            border-color: var(--accent-green);
            color: var(--accent-green);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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

        .alert-success {
            background: rgba(56, 161, 105, 0.1);
            border: 1px solid var(--accent-green);
            color: var(--accent-green);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 25px;
        }

        .alert-danger {
            background: rgba(229, 62, 62, 0.1);
            border: 1px solid #e53e3e;
            color: #e53e3e;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 25px;
        }

        .danger-zone {
            border: 2px solid #e53e3e;
            background: rgba(229, 62, 62, 0.05);
        }

        .btn-danger {
            background: #e53e3e;
            border: none;
            border-radius: 12px;
            padding: 15px 30px;
            font-size: 1rem;
            font-weight: 600;
            color: var(--white);
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: #c53030;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(229, 62, 62, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-content {
                padding: 30px 25px;
            }

            .form-section {
                padding: 20px;
            }

            .profile-header {
                padding: 30px 25px;
            }

            .profile-header h2 {
                font-size: 1.7rem;
            }

            .btn-update, .btn-cancel, .btn-danger {
                width: 100%;
                margin-bottom: 10px;
                margin-right: 0;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 20px 10px;
            }

            .profile-content {
                padding: 25px 20px;
            }

            .form-section {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-link"></i> URLShort</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                     <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('api_docs')}}">API</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('technologies')}}">Tecnologias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('benchmark')}}">Benchmark</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                {{-- Link para o Perfil --}}
                                <li>
                                    <a class="dropdown-item" href="{{ route('pages.user.profile') }}">
                                        Perfil
                                    </a>
                                </li>
                                
                                <li><hr class="dropdown-divider"></li>

                                {{-- Formulário de Logout --}}
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                            Sair
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="profile-container mt-3">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fas fa-user"></i>
                <div class="avatar-upload">
                    <i class="fas fa-camera"></i>
                </div>
            </div>
            <h2>{{ Auth::user()->name ?? 'Usuário' }}</h2>
            <p>Gerencie suas informações pessoais e configurações de conta</p>
        </div>

        <!-- Profile Content -->
        <div class="profile-content">
            <div class="section-title">
                <i class="fas fa-user-edit"></i>
                Editar Perfil
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Personal Information Section -->
            <div class="form-section">
                <h3><i class="fas fa-id-card"></i> Informações Pessoais</h3>
                
                <form method="POST" action="{{ route('profile.update') }}" id="profileForm">
                    @csrf
                    @method('PATCH')
                    
                    <div class="form-group">
                        <label for="name" class="form-label">Nome Completo</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', Auth::user()->name ?? '') }}" 
                               required 
                               autocomplete="name"
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
                               value="{{ old('email', Auth::user()->email ?? '') }}" 
                               required 
                               autocomplete="email"
                               placeholder="seu@email.com">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex flex-wrap">
                        <button type="submit" class="btn btn-update">
                            <i class="fas fa-save me-2"></i>
                            Salvar Alterações
                        </button>
                        <a href="{{ route('home') }}" class="btn btn-cancel">
                            <i class="fas fa-times me-2"></i>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Password Section -->
            <div class="form-section">
                <h3><i class="fas fa-lock"></i> Alterar Senha</h3>
                
                <form method="POST" action="{{ route('password.update') }}" id="passwordForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="current_password" class="form-label">Senha Atual</label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" 
                                   name="current_password" 
                                   required
                                   placeholder="Digite sua senha atual">
                            <span class="input-group-text" id="toggleCurrentPassword">
                                <i class="fas fa-eye" id="eyeIconCurrent"></i>
                            </span>
                        </div>
                        @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Nova Senha</label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required
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
                                   placeholder="Confirme sua nova senha">
                            <span class="input-group-text" id="togglePasswordConfirm">
                                <i class="fas fa-eye" id="eyeIconConfirm"></i>
                            </span>
                        </div>
                        <div id="passwordMatch" class="mt-2" style="font-size: 0.85rem;"></div>
                    </div>

                    <div class="d-flex flex-wrap">
                        <button type="submit" class="btn btn-update">
                            <i class="fas fa-key me-2"></i>
                            Alterar Senha
                        </button>
                    </div>
                </form>
            </div>

            <!-- Danger Zone -->
            <div class="form-section danger-zone">
                <h3><i class="fas fa-exclamation-triangle"></i> Zona de Perigo</h3>
                <p style="color: var(--text-light); margin-bottom: 20px;">
                    Esta ação é irreversível. Todos os seus dados serão permanentemente removidos.
                </p>
                
                <form method="POST" action="{{ route('profile.destroy') }}" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                        <i class="fas fa-trash me-2"></i>
                        Excluir Conta
                    </button>
                </form>
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

        // Setup all password toggles
        setupPasswordToggle('toggleCurrentPassword', 'current_password', 'eyeIconCurrent');
        setupPasswordToggle('togglePassword', 'password', 'eyeIcon');
        setupPasswordToggle('togglePasswordConfirm', 'password_confirmation', 'eyeIconConfirm');

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
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            
            if (!name || !email) {
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
        });

        // Password form validation
        document.getElementById('passwordForm').addEventListener('submit', function(e) {
            const currentPassword = document.getElementById('current_password').value;
            const password = document.getElementById('password').value;
            const passwordConfirm = document.getElementById('password_confirmation').value;
            
            if (!currentPassword || !password || !passwordConfirm) {
                e.preventDefault();
                alert('Por favor, preencha todos os campos de senha.');
                return false;
            }

            if (password.length < 8) {
                e.preventDefault();
                alert('A nova senha deve ter pelo menos 8 caracteres.');
                return false;
            }

            if (password !== passwordConfirm) {
                e.preventDefault();
                alert('As senhas não coincidem.');
                return false;
            }
        });

        // Delete account confirmation
        function confirmDelete() {
            if (confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.')) {
                if (confirm('Esta é sua última chance. Confirma a exclusão da conta?')) {
                    document.getElementById('deleteForm').submit();
                }
            }
        }

        // Add loading states
        document.getElementById('profileForm').addEventListener('submit', function() {
            const submitBtn = this.querySelector('.btn-update');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Salvando...';
            submitBtn.disabled = true;
        });

        document.getElementById('passwordForm').addEventListener('submit', function() {
            const submitBtn = this.querySelector('.btn-update');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Alterando...';
            submitBtn.disabled = true;
        });

        // Add smooth animations
        document.addEventListener('DOMContentLoaded', function() {
            const profileContainer = document.querySelector('.profile-container');
            profileContainer.style.opacity = '0';
            profileContainer.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                profileContainer.style.transition = 'all 0.6s ease';
                profileContainer.style.opacity = '1';
                profileContainer.style.transform = 'translateY(0)';
            }, 100);
        });

        // Avatar upload simulation
        document.querySelector('.avatar-upload').addEventListener('click', function() {
            alert('Funcionalidade de upload de avatar seria implementada aqui.');
        });
    </script>
</body>
</html>

