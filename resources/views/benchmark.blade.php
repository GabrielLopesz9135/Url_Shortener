<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benchmark - URL Shortener</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            background: var(--light-bg);
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

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .coming-soon-section {
            padding: 8rem 0;
            background: white;
            text-align: center;
        }

        .coming-soon-icon {
            font-size: 8rem;
            color: var(--primary-color);
            margin-bottom: 2rem;
            opacity: 0.7;
        }

        .coming-soon-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
        }

        .coming-soon-description {
            font-size: 1.25rem;
            color: var(--text-light);
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-preview {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 6rem 0;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2.5rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .feature-description {
            color: var(--text-light);
            line-height: 1.6;
        }

        .notification-section {
            padding: 4rem 0;
            background: white;
        }

        .notification-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 20px;
            padding: 3rem;
            color: white;
            text-align: center;
            box-shadow: 0 15px 40px rgba(30, 64, 175, 0.3);
        }

        .notification-form {
            max-width: 400px;
            margin: 2rem auto 0;
        }

        .notification-input {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            padding: 1rem 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            backdrop-filter: blur(10px);
        }

        .notification-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .notification-input:focus {
            border-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
            outline: none;
            background: rgba(255, 255, 255, 0.2);
        }

        .notification-btn {
            background: var(--accent-color);
            border: none;
            border-radius: 50px;
            padding: 1rem 2rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .notification-btn:hover {
            background: #d97706;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
        }

        .progress-section {
            padding: 4rem 0;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .progress-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .progress-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .progress-item:hover {
            background: #f8fafc;
        }

        .progress-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .progress-icon.completed {
            background: var(--success-color);
            color: white;
        }

        .progress-icon.in-progress {
            background: var(--warning-color);
            color: white;
        }

        .progress-icon.pending {
            background: #e2e8f0;
            color: var(--text-light);
        }

        .progress-content h6 {
            margin: 0 0 0.25rem 0;
            font-weight: 600;
        }

        .progress-content p {
            margin: 0;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .floating-element {
            position: absolute;
            opacity: 0.1;
            animation: float 8s ease-in-out infinite;
        }

        .floating-element:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
        .floating-element:nth-child(2) { top: 60%; right: 15%; animation-delay: 3s; }
        .floating-element:nth-child(3) { bottom: 30%; left: 20%; animation-delay: 6s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(10deg); }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .coming-soon-title {
                font-size: 2rem;
            }
            
            .coming-soon-icon {
                font-size: 5rem;
            }
            
            .feature-card {
                padding: 2rem;
            }
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 3rem;
            color: var(--text-dark);
        }

        .section-subtitle {
            text-align: center;
            color: var(--text-light);
            font-size: 1.1rem;
            margin-bottom: 4rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
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
                        <a class="nav-link active" href="{{route('benchmark')}}">Benchmark</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="floating-elements">
            <i class="floating-element fas fa-chart-line fa-3x"></i>
            <i class="floating-element fas fa-tachometer-alt fa-3x"></i>
            <i class="floating-element fas fa-stopwatch fa-3x"></i>
        </div>
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">Benchmark de Performance</h1>
                <p class="hero-subtitle">
                    Testes detalhados de performance, comparações com concorrentes e métricas 
                    de velocidade para demonstrar a superioridade da nossa solução.
                </p>
            </div>
        </div>
    </section>

    <!-- Coming Soon Section -->
    <!-- <section class="coming-soon-section">
        <div class="container">
            <div class="coming-soon-icon pulse-animation">
                <i class="fas fa-rocket"></i>
            </div>
            <h2 class="coming-soon-title">Em Breve</h2>
            <p class="coming-soon-description">
                Estamos preparando testes abrangentes de performance e comparações detalhadas 
                com outros serviços de encurtamento de URL. Em breve você poderá ver como 
                nossa solução se destaca em velocidade, confiabilidade e eficiência.
            </p>
        </div>
    </section> -->

    <h3 class="section-title mt-5 mb-3">Resumo dos Testes</h3>
    <ul class="text-center">
        <strong>Ferramenta:</strong> Apache Benchmark <br>
        <strong>Requisições:</strong> 5000 requisições com 100 concorrentes <br>
        <strong>Ambiente:</strong> Containers Docker (App, MongoDB, Redis, NGINX)
    </ul>

    <h3 class="section-title mt-5 mb-3">Comparativo Técnico</h3>
    <div class="table-responsive p-3">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Métrica</th>
                    <th>MongoDB Direto</th>
                    <th>Redis + Flush 5s</th>
                    <th>Observações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>CPU - App</td>
                    <td>~500%</td>
                    <td>~500%</td>
                    <td>Alta carga de CPU em ambos</td>
                </tr>
                <tr>
                    <td>Memória - App</td>
                    <td>90MB</td>
                    <td class="highlight">250MB</td>
                    <td style="background: var(--danger-color);">Redis aumenta uso de memória</td>
                </tr>
                <tr>
                    <td>Disk I/O - App</td>
                    <td>30MB / 0MB</td>
                    <td>30MB / 0MB</td>
                    <td>Sem mudanças significativas</td>
                </tr>
                <tr>
                    <td>Network I/O - App</td>
                    <td>15MB / 11MB</td>
                    <td>15MB / 11MB</td>
                    <td>Sem mudanças significativas</td>
                </tr>
                <tr>
                    <td>CPU - Mongo</td>
                    <td class="highlight">~5%</td>
                    <td>0.2–0.7%</td>
                    <td style="background: var(--success-color);">Grande alívio na carga do banco</td>
                </tr>
                <tr>
                    <td>Network I/O - Mongo</td>
                    <td class="highlight">2.4MB / 500KB</td>
                    <td>60KB / 80KB</td>
                    <td style="background: var(--success-color);">Tráfego reduzido em >90%</td>
                </tr>
                <tr>
                    <td>CPU - Redis</td>
                    <td>5%</td>
                    <td>5%</td>
                    <td>Sem impacto significativo</td>
                </tr>
                <tr>
                    <td>Memória - Redis</td>
                    <td>&lt;10MB</td>
                    <td>&lt;10MB</td>
                    <td>Uso leve</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h3 class="section-title mt-5 mb-3">Conclusões</h3>
    <ul class="text-center mb-5">
        <strong>✔️ Escalabilidade:</strong> Redis permite lidar com mais requisições sem sobrecarregar o banco. <br>
        <strong>✔️ Desempenho:</strong> Redução drástica na carga do MongoDB e no tráfego de rede. <br>
        <strong>⚠️ Consistência:</strong> Existe uma latência de até 5s na persistência final dos dados. <br>
        <strong>⚠️ Perda de Dados:</strong> Risco de perda caso a aplicação pare antes da sincronização.
    </ul>
<!-- 
    <div class="p-3">
    <h3 class="section-title mt-5 mb-3">Recomendações</h3>
        <p>Para ambientes de alta escala, a abordagem com Redis se mostra mais eficiente. Recomendado aplicar estratégias de persistência segura (como Redis AOF ou flush com fallback) para mitigar perdas.</p>
    </div> -->
    

    <!-- Features Preview -->
    <!-- <section class="features-preview">
        <div class="container">
            <h2 class="section-title">O que Você Encontrará Aqui</h2>
            <p class="section-subtitle">
                Quando estiver pronto, esta seção incluirá análises completas de performance
            </p>
            
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-stopwatch"></i>
                        </div>
                        <h4 class="feature-title">Testes de Velocidade</h4>
                        <p class="feature-description">
                            Medições precisas de tempo de resposta, latência e throughput 
                            em diferentes cenários de carga e uso.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <h4 class="feature-title">Comparações</h4>
                        <p class="feature-description">
                            Análises lado a lado com principais concorrentes como Bitly, 
                            TinyURL e outros serviços populares do mercado.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h4 class="feature-title">Métricas Detalhadas</h4>
                        <p class="feature-description">
                            Gráficos interativos, estatísticas de uptime, análise de 
                            escalabilidade e relatórios de stress testing.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Progress Section -->
    <section class="progress-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="section-title">Progresso do Desenvolvimento</h2>
                    <div class="progress-card">
                        <div class="progress-item">
                            <div class="progress-icon completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="progress-content">
                                <h6>Infraestrutura Base</h6>
                                <p>Sistema de monitoramento e coleta de métricas implementado</p>
                            </div>
                        </div>
                        
                        <div class="progress-item">
                            <div class="progress-icon completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="progress-content">
                                <h6>Ferramentas de Teste</h6>
                                <p>Configuração de ambiente para testes de carga e performance</p>
                            </div>
                        </div>
                        
                        <div class="progress-item">
                            <div class="progress-icon in-progress">
                                <i class="fas fa-cog fa-spin"></i>
                            </div>
                            <div class="progress-content">
                                <h6>Coleta de Dados</h6>
                                <p>Executando testes e coletando métricas de performance</p>
                            </div>
                        </div>
                        
                        <!-- <div class="progress-item">
                            <div class="progress-icon pending">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="progress-content">
                                <h6>Análise Comparativa</h6>
                                <p>Comparação com concorrentes e análise de resultados</p>
                            </div>
                        </div>
                        
                        <div class="progress-item">
                            <div class="progress-icon pending">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="progress-content">
                                <h6>Interface de Benchmark</h6>
                                <p>Desenvolvimento da interface para visualização dos resultados</p>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
 


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

