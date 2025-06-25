<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'LinkApp') }} - Link Não Encontrado</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-blue: #1a365d;
            --accent-green: #38a169;
            --accent-yellow: #d69e2e;
            --text-dark: #2d3748;
            --text-light: #718096;
            --bg-light: #f7fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--primary-blue) 0%, #2d3748 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
        }

        .error-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(26, 54, 93, 0.15);
            padding: 50px 40px;
            max-width: 500px;
            width: 90%;
            text-align: center;
        }

        .logo {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .logo i {
            color: var(--accent-green);
        }

        .error-icon {
            font-size: 4rem;
            color: var(--accent-yellow);
            margin-bottom: 20px;
        }

        .error-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 15px;
        }

        .error-subtitle {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .error-reasons {
            background: var(--bg-light);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: left;
        }

        .error-reasons h6 {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 15px;
            text-align: center;
        }

        .error-reasons ul {
            list-style: none;
            padding: 0;
        }

        .error-reasons li {
            color: var(--text-light);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .error-reasons li i {
            color: var(--accent-green);
            width: 16px;
        }

        .btn-home {
            background: linear-gradient(135deg, var(--accent-green) 0%, #48bb78 100%);
            border: none;
            border-radius: 12px;
            padding: 15px 30px;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(56, 161, 105, 0.3);
            color: white;
            text-decoration: none;
        }

        .url-display {
            background: rgba(26, 54, 93, 0.1);
            border-radius: 8px;
            padding: 12px;
            margin: 20px 0;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            color: var(--primary-blue);
            word-break: break-all;
            border-left: 4px solid var(--accent-yellow);
        }

        @media (max-width: 768px) {
            .error-container {
                padding: 40px 30px;
                margin: 20px;
            }
            
            .logo {
                font-size: 1.7rem;
            }
            
            .error-title {
                font-size: 1.7rem;
            }
            
            .error-icon {
                font-size: 3rem;
            }
        }

        @media (max-width: 480px) {
            .error-container {
                padding: 30px 20px;
            }
            
            .logo {
                font-size: 1.5rem;
            }
            
            .error-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <!-- Logo -->
        <div class="logo">
            <i class="fas fa-link"></i>
            {{ config('app.name', 'LinkApp') }}
        </div>

        <!-- Error Icon -->
        <div class="error-icon">
            <i class="fas fa-unlink"></i>
        </div>

        <!-- Error Content -->
        <h1 class="error-title">Link Não Encontrado</h1>
        <p class="error-subtitle">
            O link que você está tentando acessar não existe ou pode ter expirado.
        </p>

        <!-- URL Display (if available) -->
        @if(request()->getRequestUri())
            <div class="url-display">
                <strong>URL acessada:</strong> {{ request()->getHttpHost() . request()->getRequestUri() }}
            </div>
        @endif

        <!-- Possible Reasons -->
        <div class="error-reasons">
            <h6>Possíveis motivos:</h6>
            <ul>
                <li>
                    <i class="fas fa-clock"></i>
                    O link expirou e foi removido automaticamente
                </li>
                <li>
                    <i class="fas fa-trash"></i>
                    O link foi excluído pelo usuário
                </li>
                <li>
                    <i class="fas fa-edit"></i>
                    Pode haver um erro de digitação na URL
                </li>
                <li>
                    <i class="fas fa-ban"></i>
                    O link pode ter sido desativado por violação de políticas
                </li>
            </ul>
        </div>

        <!-- Action Button -->
        <a href="{{ config('app.url', '/') }}" class="btn-home">
            <i class="fas fa-home"></i>
            Criar Novo Link
        </a>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Simple entrance animation
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.error-container');
            container.style.opacity = '0';
            container.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                container.style.transition = 'all 0.6s ease';
                container.style.opacity = '1';
                container.style.transform = 'translateY(0)';
            }, 100);
        });

        // Track 404 for analytics (optional)
        if (typeof gtag !== 'undefined') {
            gtag('event', 'short_link_not_found', {
                'page_location': window.location.href,
                'page_referrer': document.referrer
            });
        }
    </script>
</body>
</html>

