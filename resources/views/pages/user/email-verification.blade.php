<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }} - Verificação de E-mail</title>
    
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

        .verify-container {
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

        .email-icon {
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

        .email-icon i {
            font-size: 3rem;
            color: var(--accent-green);
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
            color: var(--accent-yellow);
            font-size: 1.2rem;
        }

        .verify-panel {
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

        .verification-status {
            background: rgba(56, 161, 105, 0.1);
            border: 2px solid var(--accent-green);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            text-align: center;
        }

        .verification-status.pending {
            background: rgba(214, 158, 46, 0.1);
            border-color: var(--accent-yellow);
        }

        .verification-status.error {
            background: rgba(229, 62, 62, 0.1);
            border-color: #e53e3e;
        }

        .status-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            display: block;
        }

        .status-icon.success {
            color: var(--accent-green);
        }

        .status-icon.pending {
            color: var(--accent-yellow);
            animation: spin 2s linear infinite;
        }

        .status-icon.error {
            color: #e53e3e;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .status-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .status-message {
            color: var(--text-light);
            font-size: 1rem;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .email-highlight {
            background: rgba(56, 161, 105, 0.1);
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 600;
            color: var(--accent-green);
        }

        .verification-steps {
            background: #f8fafc;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            border-left: 4px solid var(--accent-green);
        }

        .verification-steps h4 {
            color: var(--text-dark);
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .verification-steps h4 i {
            margin-right: 10px;
            color: var(--accent-green);
        }

        .verification-steps ol {
            margin: 0;
            padding-left: 20px;
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .verification-steps li {
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .btn-resend {
            background: linear-gradient(135deg, var(--primary-dark-blue) 0%, var(--secondary-blue) 100%);
            border: none;
            border-radius: 12px;
            padding: 15px 30px;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            margin-right: 15px;
        }

        .btn-resend:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 54, 93, 0.3);
            background: linear-gradient(135deg, #2d3748 0%, var(--primary-dark-blue) 100%);
        }

        .btn-secondary {
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

        .btn-secondary:hover {
            border-color: var(--accent-green);
            color: var(--accent-green);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 25px;
        }

        .countdown-timer {
            background: rgba(214, 158, 46, 0.1);
            border: 1px solid var(--accent-yellow);
            border-radius: 8px;
            padding: 10px 15px;
            margin-top: 15px;
            text-align: center;
            font-size: 0.9rem;
            color: var(--accent-yellow);
        }

        .countdown-timer i {
            margin-right: 8px;
        }

        .help-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-top: 30px;
            border: 1px solid #e2e8f0;
        }

        .help-section h5 {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .help-section h5 i {
            margin-right: 10px;
            color: var(--accent-green);
        }

        .help-section ul {
            margin: 0;
            padding-left: 20px;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .help-section li {
            margin-bottom: 8px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .verify-container {
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

            .verify-panel {
                padding: 40px 30px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-resend, .btn-secondary {
                width: 100%;
                margin-right: 0;
            }
        }

        @media (max-width: 480px) {
            .welcome-panel {
                padding: 30px 20px;
            }

            .verify-panel {
                padding: 30px 20px;
            }

            .brand-logo h1 {
                font-size: 1.7rem;
            }

            .email-icon {
                width: 100px;
                height: 100px;
            }

            .email-icon i {
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
                <div class="verify-container mx-auto">
                    <!-- Welcome Panel -->
                    <div class="welcome-panel">
                        <div class="email-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h2>Verifique seu E-mail</h2>
                        <p>Estamos quase lá! Precisamos apenas confirmar que você tem acesso ao seu e-mail para completar o cadastro.</p>
                        
                        <ul class="welcome-features">
                            <li>
                                <i class="fas fa-shield-alt"></i>
                                <span>Segurança garantida</span>
                            </li>
                            <li>
                                <i class="fas fa-clock"></i>
                                <span>Processo rápido</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Verificação simples</span>
                            </li>
                            <li>
                                <i class="fas fa-user-check"></i>
                                <span>Conta protegida</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Verify Panel -->
                    <div class="verify-panel">
                        <div class="brand-logo">
                            <h1><i class="fas fa-link" style="color: var(--accent-green);"></i>URLShort</h1>
                            <p>Verificação de e-mail</p>
                        </div>

                        <!-- Verification Status -->
                        <div class="verification-status pending" id="verificationStatus">
                            <i class="fas fa-clock status-icon pending" id="statusIcon"></i>
                            <h3 class="status-title" id="statusTitle">Aguardando Verificação</h3>
                            <p class="status-message" id="statusMessage">
                                Enviamos um e-mail de verificação para <span class="email-highlight" id="userEmail">{{ Auth::user()->email ?? 'seu@email.com' }}</span>
                            </p>
                        </div>

                        <!-- Verification Steps -->
                        <div class="verification-steps" id="verification-steps">
                            <h4><i class="fas fa-list-ol"></i>Como verificar seu e-mail:</h4>
                            <ol>
                                <li>Abra seu cliente de e-mail ou acesse sua conta online</li>
                                <li>Procure por um e-mail de <strong> URLShort </strong></li>
                                <li>Verifique também a pasta de spam ou lixo eletrônico</li>
                                <li>Clique no link "Verificar E-mail" dentro da mensagem</li>
                                <li>Você será redirecionado de volta para nossa plataforma</li>
                            </ol>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons mx-auto">
                                <button type="submit" class="btn btn-resend" id="resendBtn">
                                    <i class="fas fa-paper-plane me-2"></i> Reenviar E-mail
                                </button>
                        </div>

                        <!-- Countdown Timer -->
                        <div class="countdown-timer" id="countdownTimer">
                            <i class="fas fa-hourglass-half"></i>
                            Você pode solicitar um novo e-mail em <span id="countdown">60</span> segundos
                        </div>

                        <!-- Help Section -->
                        <div class="help-section" id="help-section">
                            <h5><i class="fas fa-question-circle"></i>Não recebeu o e-mail?</h5>
                            <ul>
                                <li>Verifique sua pasta de spam ou lixo eletrônico</li>
                                <li>Certifique-se de que o endereço de e-mail está correto</li>
                                <li>Aguarde alguns minutos, pois pode haver atraso na entrega</li>
                                <li>Tente adicionar nosso domínio à sua lista de remetentes confiáveis</li>
                                <li>Se o problema persistir, entre em contato com nosso suporte</li>
                            </ul>
                        </div>

                        <!-- Logout Option -->
                        <div style="text-align: center; margin-top: 30px; padding-top: 25px; border-top: 1px solid #e2e8f0;">
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: none; border: none; color: var(--text-light); text-decoration: underline; cursor: pointer;">
                                    <i class="fas fa-sign-out-alt me-1"></i>
                                    Sair da conta
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Countdown timer for resend button
        let countdownTime = 60;
        let countdownInterval;

        function startCountdown() {
            const countdownElement = document.getElementById('countdown');
            const timerElement = document.getElementById('countdownTimer');
            const resendBtn = document.getElementById('resendBtn');
            
            resendBtn.disabled = true;
            timerElement.style.display = 'block';
            
            countdownInterval = setInterval(() => {
                countdownTime--;
                countdownElement.textContent = countdownTime;
                
                if (countdownTime <= 0) {
                    clearInterval(countdownInterval);
                    resendBtn.disabled = false;
                    timerElement.style.display = 'none';
                    countdownTime = 60;
                }
            }, 1000);
        }

        function sendEmailVerification() {
            let button = document.getElementById('resendBtn')
            let email = document.getElementById('userEmail').textContent
            let Authorization = "Bearer {{ Auth::user()->api_key }}";
            
            // Chamada real à API
            fetch("http://localhost/api/send-email-verify", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": Authorization
                },
                body: JSON.stringify({
                    email: email
                })
            })
            .then(data => {
                button.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Reenviar E-mail';
                showSuccessMessage(); 
                startCountdown();     
            })
            .finally(() => {
                button.disabled = false;
            });
        }

        // Handle resend button click
        document.getElementById('resendBtn').addEventListener('click', function(e) {
            e.preventDefault();
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enviando...';
            this.disabled = true;
            sendEmailVerification();
        });

        // Show success message after resend
        function showSuccessMessage() {
            const statusDiv = document.getElementById('verificationStatus');
            const statusIcon = document.getElementById('statusIcon');
            const statusTitle = document.getElementById('statusTitle');
            const statusMessage = document.getElementById('statusMessage');
            
            statusDiv.className = 'verification-status';
            statusIcon.className = 'fas fa-check-circle status-icon success';
            statusTitle.textContent = 'E-mail Reenviado!';
            statusMessage.innerHTML = 'Um novo e-mail de verificação foi enviado para <span class="email-highlight">' + 
                                     document.getElementById('userEmail').textContent + '</span>';
            
            setTimeout(() => {
                statusDiv.className = 'verification-status pending';
                statusIcon.className = 'fas fa-clock status-icon pending';
                statusTitle.textContent = 'Aguardando Verificação';
                statusMessage.innerHTML = 'Enviamos um e-mail de verificação para <span class="email-highlight">' + 
                                         document.getElementById('userEmail').textContent + '</span>';
            }, 10000);
        }

        // Check verification status periodically
       function checkVerificationStatus() {

            const statusDiv = document.getElementById('verificationStatus');
            const statusIcon = document.getElementById('statusIcon');
            const statusTitle = document.getElementById('statusTitle');
            const statusMessage = document.getElementById('statusMessage');
            const helpsection = document.getElementById('help-section');
            const verificationsteps = document.getElementById('verification-steps');

            const status = '{{ $status }}';

             if(status == true){
                statusDiv.className = 'verification-status';
                statusIcon.className = 'fas fa-check-circle status-icon success';
                statusTitle.textContent = 'E-mail Verificado!';
                statusMessage.innerHTML = '{{ $message }} Você já pode acessar todos os recursos da plataforma.';
                helpsection.className = 'd-none';
                verificationsteps.className = 'd-none';
                
                // Hide countdown timer
                document.getElementById('countdownTimer').style.display = 'none';
                
                // Update buttons
                const actionButtons = document.querySelector('.action-buttons');
                actionButtons.innerHTML = `
                    <a href="{{ route('home') }}" class="btn btn-resend">
                        <i class="fas fa-home me-2"></i>
                        Ir para Dashboard
                    </a>
                `;
             }
             if(status == false){
                statusDiv.className = 'verification-status error';
                statusIcon.className = 'fas fa-circle-xmark status-icon error';
                statusTitle.textContent = 'E-mail Não Verificado!';
                statusMessage.innerHTML = '{{ $message }} Tente Novamente em Alguns Instantes.';
             }

             return status;
        } 

        // Start countdown on page load
        document.addEventListener('DOMContentLoaded', function() {
            startCountdown();
            let status = checkVerificationStatus();

            if(status != true){
                sendEmailVerification();
            }
            
            // Add smooth animations
            const verifyContainer = document.querySelector('.verify-container');
            verifyContainer.style.opacity = '50';
            verifyContainer.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                verifyContainer.style.transition = 'all 0.6s ease';
                verifyContainer.style.opacity = '1';
                verifyContainer.style.transform = 'translateY(0)';
            }, 100);
        }); 

    </script>
</body>
</html>

