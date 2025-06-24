<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> URL Shortener - Contador de Cliques</title>
    
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
            position: relative;
            overflow-x: hidden;
        }

        /* Background decorative elements */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(56, 161, 105, 0.1) 0%, transparent 70%);
            animation: float 8s ease-in-out infinite;
            z-index: 1;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(214, 158, 46, 0.1) 0%, transparent 70%);
            animation: float 10s ease-in-out infinite reverse;
            z-index: 1;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }

        .counter-container {
            background: var(--white);
            border-radius: 25px;
            box-shadow: 0 25px 80px rgba(26, 54, 93, 0.2);
            padding: 60px 50px;
            width: 100%;
            max-width: 600px;
            text-align: center;
            position: relative;
            z-index: 10;
            backdrop-filter: blur(10px);
        }

        .brand-header {
            margin-bottom: 40px;
        }

        .brand-logo {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-dark-blue);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-logo i {
            color: var(--accent-green);
            margin-right: 12px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .brand-subtitle {
            color: var(--text-light);
            font-size: 1.1rem;
            font-weight: 400;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 15px;
        }

        .page-description {
            color: var(--text-light);
            font-size: 1rem;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .counter-form {
            margin-bottom: 30px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 25px;
        }

        .form-control-custom {
            border: 3px solid #e2e8f0;
            border-radius: 15px;
            padding: 18px 25px;
            font-size: 1.1rem;
            width: 100%;
            transition: all 0.3s ease;
            background-color: #f8fafc;
            color: var(--text-dark);
        }

        .form-control-custom:focus {
            outline: none;
            border-color: var(--accent-green);
            box-shadow: 0 0 0 4px rgba(56, 161, 105, 0.1);
            background-color: var(--white);
            transform: translateY(-2px);
        }

        .form-control-custom::placeholder {
            color: var(--text-light);
            font-weight: 400;
        }

        .btn-search {
            background: linear-gradient(135deg, var(--accent-green) 0%, #48bb78 100%);
            border: none;
            border-radius: 15px;
            padding: 18px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--white);
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-search:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(56, 161, 105, 0.3);
            background: linear-gradient(135deg, #48bb78 0%, var(--accent-green) 100%);
            color: var(--white);
        }

        .btn-search:active {
            transform: translateY(-1px);
        }

        .btn-search::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-search:hover::before {
            left: 100%;
        }

        .results-container {
            margin-top: 30px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .results-container.show {
            opacity: 1;
            transform: translateY(0);
        }

        .result-card {
            background: linear-gradient(135deg, var(--light-gray) 0%, #ffffff 100%);
            border: 2px solid #e2e8f0;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 20px;
        }

        .result-success {
            border-color: var(--accent-green);
            background: linear-gradient(135deg, rgba(56, 161, 105, 0.1) 0%, #ffffff 100%);
        }

        .result-error {
            border-color: #e53e3e;
            background: linear-gradient(135deg, rgba(229, 62, 62, 0.1) 0%, #ffffff 100%);
        }

        .click-count {
            font-size: 3rem;
            font-weight: 700;
            color: var(--accent-green);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .click-count i {
            margin-right: 15px;
            font-size: 2.5rem;
        }

        .click-label {
            font-size: 1.2rem;
            color: var(--text-dark);
            font-weight: 500;
            margin-bottom: 15px;
        }

        .link-info {
            background: rgba(26, 54, 93, 0.1);
            border-radius: 12px;
            padding: 15px;
            margin-top: 20px;
        }

        .link-url {
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            color: var(--primary-dark-blue);
            word-break: break-all;
            font-weight: 500;
        }

        .error-message {
            color: #e53e3e;
            font-size: 1.1rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-message i {
            margin-right: 10px;
            font-size: 1.3rem;
        }

        .loading-spinner {
            display: none;
            margin: 20px 0;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #e2e8f0;
            border-top: 4px solid var(--accent-green);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .additional-info {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .info-item {
            text-align: center;
            padding: 15px;
            background: rgba(56, 161, 105, 0.1);
            border-radius: 12px;
        }

        .info-item i {
            font-size: 1.5rem;
            color: var(--accent-green);
            margin-bottom: 8px;
            display: block;
        }

        .info-item h6 {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .info-item p {
            font-size: 0.8rem;
            color: var(--text-light);
            margin: 0;
        }

        .back-link {
            margin-top: 30px;
            text-align: center;
        }

        .back-link a {
            color: var(--accent-green);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .back-link a:hover {
            text-decoration: underline;
            transform: translateX(-5px);
        }

        .back-link a i {
            margin-right: 8px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .counter-container {
                margin: 20px;
                padding: 40px 30px;
                border-radius: 20px;
            }

            .brand-logo {
                font-size: 2rem;
            }

            .page-title {
                font-size: 1.7rem;
            }

            .form-control-custom {
                padding: 15px 20px;
                font-size: 1rem;
            }

            .btn-search {
                padding: 15px 30px;
                font-size: 1rem;
            }

            .click-count {
                font-size: 2.5rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .counter-container {
                margin: 15px;
                padding: 30px 20px;
            }

            .brand-logo {
                font-size: 1.8rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .click-count {
                font-size: 2rem;
            }
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="counter-container">
        <!-- Brand Header -->
        <div class="brand-header">
            <div class="brand-logo">
                <h1><i class="fas fa-link" style="color: var(--accent-green);"></i><a style="text-decoration: none; color: var(--primary-dark-blue);" href="{{route('home')}}">URLShort</a></h1>
            </div>
            <div class="brand-subtitle">Contador de Cliques</div>
        </div>

        <!-- Page Title -->
        <h1 class="page-title">Verificar Cliques</h1>
        <p class="page-description">
            Digite o link encurtado abaixo para verificar quantas vezes ele foi clicado
        </p>

        <!-- Counter Form -->
        <form class="counter-form" id="counterForm"  action="{{ route('urls.stats')}}" method="POST">
            @csrf
            @method('POST')
            <div class="input-group-custom">
                <input type="url" 
                       class="form-control-custom" 
                       id="linkInput" 
                       name="url" 
                       placeholder="https://exemplo.com/abc123" 
                       required>
            </div>
            
            <button type="submit" class="btn btn-search" id="searchBtn">
                <i class="fas fa-search me-2"></i>
                Verificar Cliques
            </button>
        </form>

        <!-- Loading Spinner -->
        <div class="loading-spinner" id="loadingSpinner">
            <div class="spinner"></div>
            <p style="margin-top: 15px; color: var(--text-light);">Verificando cliques...</p>
        </div>

        <!-- Results Container -->
        <div class="results-container" id="resultsContainer">
            <!-- Results will be inserted here by JavaScript -->
        </div>

        <!-- Additional Info -->
        <div class="additional-info">
            <div class="info-grid">
                <div class="info-item">
                    <i class="fas fa-chart-line"></i>
                    <h6>Estatísticas</h6>
                    <p>Dados em tempo real</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-shield-alt"></i>
                    <h6>Seguro</h6>
                    <p>Verificação segura</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <h6>Rápido</h6>
                    <p>Resultados instantâneos</p>
                </div>
            </div>
        </div>

        <!-- Back Link -->
        <div class="back-link">
            @if (Route::has('dashboard'))
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-arrow-left"></i>
                    Voltar ao Dashboard
                </a>
            @else
                <a href="/">
                    <i class="fas fa-home"></i>
                    Página Inicial
                </a>
            @endif
        </div>
    </div>

      @php
        $status = $status ?? false;
        $message = $message ?? '';
        $data['short_url'] = $data['short_url'] ?? null;

    @endphp

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        const status = "{{ $status }}";

        document.addEventListener('DOMContentLoaded', function() {
            
            const status = "{{ session('status') }}";
            const message = "{{ session('message') }}";
            const clickCount = "{{ session('data.clicks') }}";
            const link = "{{ session('data.original_url') }}";

            console.log(status, message, link, clickCount);


                if (status == "Success") {
                    showSuccess(link, clickCount)
                    
                }if(status == "Error") {
                    showError(message);
                }
        });

        // Show success result
        function showSuccess(link, clickCount) {
            const resultsContainer = document.getElementById('resultsContainer');
            
            resultsContainer.innerHTML = `
                <div class="result-card result-success">
                    <div class="click-count">
                        <i class="fas fa-mouse-pointer"></i>
                        ${clickCount.toLocaleString('pt-BR')}
                    </div>
                    <div class="click-label">
                        ${clickCount === 1 ? 'clique registrado' : 'cliques registrados'}
                    </div>
                    <div class="link-info">
                        <div class="link-url">${link}</div>
                    </div>
                </div>
            `;
            
            resultsContainer.classList.add('show');
        }

        // Show error result
        function showError(message) {
            const resultsContainer = document.getElementById('resultsContainer');
            
            resultsContainer.innerHTML = `
                <div class="result-card result-error">
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        ${message}
                    </div>
                </div>
            `;
            
            resultsContainer.classList.add('show');
        }

        // Auto-focus input on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('linkInput').focus();
            
            // Add smooth entrance animation
            const container = document.querySelector('.counter-container');
            container.style.opacity = '0';
            container.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                container.style.transition = 'all 0.6s ease';
                container.style.opacity = '1';
                container.style.transform = 'translateY(0)';
            }, 100);
        });

        // Clear results when input changes
        document.getElementById('linkInput').addEventListener('input', function() {
            const resultsContainer = document.getElementById('resultsContainer');
            if (resultsContainer.classList.contains('show')) {
                resultsContainer.classList.remove('show');
                setTimeout(() => {
                    resultsContainer.innerHTML = '';
                }, 500);
            }
        });

        // Handle Enter key in input
        document.getElementById('linkInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('counterForm').dispatchEvent(new Event('submit'));
            }
        });

        // Example function for actual API integration
        async function getClickCount(link) {
            try {
                const response = await fetch('/api/click-count', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ link: link })
                });

                if (!response.ok) {
                    throw new Error('Erro na requisição');
                }

                const data = await response.json();
                
                if (data.success) {
                    showSuccess(link, data.click_count);
                } else {
                    showError(data.message || 'Erro ao buscar dados do link.');
                }
            } catch (error) {
                console.error('Erro:', error);
                showError('Erro de conexão. Tente novamente.');
            }
        }
    </script>
</body>
</html>

