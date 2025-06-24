<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tecnologias - URL Shortener</title>
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
            --laravel-color: #ff2d20;
            --docker-color: #2496ed;
            --mongodb-color: #47a248;
            --redis-color: #dc382d;
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

        .tech-overview {
            padding: 6rem 0;
            background: white;
        }

        .tech-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            transition: all 0.4s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .tech-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--tech-color, var(--primary-color));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .tech-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .tech-card:hover::before {
            transform: scaleX(1);
        }

        .tech-card.laravel { --tech-color: var(--laravel-color); }
        .tech-card.docker { --tech-color: var(--docker-color); }
        .tech-card.mongodb { --tech-color: var(--mongodb-color); }
        .tech-card.redis { --tech-color: var(--redis-color); }

        .tech-icon {
            width: 80px;
            height: 80px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            font-size: 2.5rem;
            color: white;
            background: var(--tech-color, var(--primary-color));
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .tech-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .tech-description {
            color: var(--text-light);
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .tech-features {
            list-style: none;
            padding: 0;
        }

        .tech-features li {
            padding: 0.5rem 0;
            color: var(--text-light);
            position: relative;
            padding-left: 2rem;
        }

        .tech-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--tech-color, var(--primary-color));
            font-weight: 700;
        }

        .architecture-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .architecture-diagram {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            margin-bottom: 3rem;
        }

        .diagram-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .diagram-component {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            min-width: 150px;
            transition: all 0.3s ease;
            position: relative;
        }

        .diagram-component:hover {
            transform: scale(1.05);
            border-color: var(--primary-color);
            box-shadow: 0 8px 25px rgba(30, 64, 175, 0.15);
        }

        .diagram-component .icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--component-color, var(--primary-color));
        }

        .diagram-component.frontend { --component-color: var(--accent-color); }
        .diagram-component.api { --component-color: var(--laravel-color); }
        .diagram-component.cache { --component-color: var(--redis-color); }
        .diagram-component.database { --component-color: var(--mongodb-color); }

        .diagram-arrow {
            font-size: 2rem;
            color: var(--text-light);
            margin: 0 1rem;
        }

        .stats-section {
            padding: 6rem 0;
            background: white;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 15px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-light);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 1px;
        }

        .benefits-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, var(--dark-bg) 0%, #1e293b 100%);
            color: white;
        }

        .benefit-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .benefit-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(10px);
        }

        .benefit-icon {
            font-size: 2rem;
            color: var(--accent-color);
            margin-right: 1.5rem;
            margin-top: 0.5rem;
        }

        .benefit-content h5 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .benefit-content p {
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .tech-card {
                padding: 2rem;
            }
            
            .diagram-container {
                flex-direction: column;
            }
            
            .diagram-arrow {
                transform: rotate(90deg);
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
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
        .floating-element:nth-child(2) { top: 60%; right: 15%; animation-delay: 2s; }
        .floating-element:nth-child(3) { bottom: 30%; left: 20%; animation-delay: 4s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
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
                        <a class="nav-link active" href="{{route('technologies')}}">Tecnologias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('benchmark')}}">Benchmark</a>
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
            <i class="floating-element fab fa-laravel fa-3x"></i>
            <i class="floating-element fab fa-docker fa-3x"></i>
            <i class="floating-element fas fa-database fa-3x"></i>
        </div>
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">Stack Tecnológico Moderno</h1>
                <p class="hero-subtitle">
                    Construído com as melhores tecnologias para garantir performance, 
                    escalabilidade e confiabilidade em cada encurtamento de URL.
                </p>
            </div>
        </div>
    </section>

    <!-- Technologies Overview -->
    <section class="tech-overview">
        <div class="container">
            <h2 class="section-title">Nossas Tecnologias</h2>
            <p class="section-subtitle">
                Cada tecnologia foi cuidadosamente escolhida para criar uma solução robusta e eficiente
            </p>
            
            <div class="row">
                <!-- Laravel -->
                <div class="col-lg-6 mb-4">
                    <div class="tech-card laravel">
                        <div class="tech-icon">
                            <i class="fab fa-laravel"></i>
                        </div>
                        <h3 class="tech-title">Laravel</h3>
                        <p class="tech-description">
                            Framework PHP elegante e expressivo que nos permite desenvolver APIs robustas 
                            com código limpo e arquitetura bem estruturada.
                        </p>
                        <ul class="tech-features">
                            <li>Eloquent ORM para interações com banco de dados</li>
                            <li>Middleware para autenticação e segurança</li>
                            <li>Sistema de cache integrado</li>
                            <li>Validação de dados robusta</li>
                        </ul>
                    </div>
                </div>

                <!-- Docker -->
                <div class="col-lg-6 mb-4">
                    <div class="tech-card docker">
                        <div class="tech-icon">
                            <i class="fab fa-docker"></i>
                        </div>
                        <h3 class="tech-title">Docker</h3>
                        <p class="tech-description">
                            Containerização que garante consistência entre ambientes de desenvolvimento, 
                            teste e produção, facilitando deploy e escalabilidade.
                        </p>
                        <ul class="tech-features">
                            <li>Ambientes isolados e reproduzíveis</li>
                            <li>Deploy simplificado e consistente</li>
                            <li>Orquestração com Docker Compose</li>
                            <li>Otimização de recursos do servidor</li>
                            <li>Rollback rápido em caso de problemas</li>
                        </ul>
                    </div>
                </div>

                <!-- MongoDB -->
                <div class="col-lg-6 mb-4">
                    <div class="tech-card mongodb">
                        <div class="tech-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h3 class="tech-title">MongoDB</h3>
                        <p class="tech-description">
                            Banco de dados NoSQL que oferece flexibilidade e performance para 
                            armazenar URLs e analytics com esquemas dinâmicos.
                        </p>
                        <ul class="tech-features">
                            <li>Esquema flexível para diferentes tipos de dados</li>
                            <li>Consultas rápidas com indexação avançada</li>
                            <li>Sharding para escalabilidade horizontal</li>
                            <li>Suporte nativo a dados geoespaciais</li>
                        </ul>
                    </div>
                </div>

                <!-- Redis -->
                <div class="col-lg-6 mb-4">
                    <div class="tech-card redis">
                        <div class="tech-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3 class="tech-title">Redis</h3>
                        <p class="tech-description">
                            Cache em memória ultra-rápido que acelera consultas frequentes 
                            e gerencia sessões para uma experiência de usuário otimizada.
                        </p>
                        <ul class="tech-features">
                            <li>Cache de URLs</li>
                            <li>Gerenciamento de sessões de usuário</li>
                            <li>Rate limiting para proteção da API</li>
                            <li>Estruturas de dados avançadas</li>
                            <li>Persistência configurável</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Architecture Diagram -->
    <section class="architecture-section">
        <div class="container">
            <h2 class="section-title">Arquitetura do Sistema</h2>
            <p class="section-subtitle">
                Veja como nossas tecnologias trabalham juntas para criar uma solução completa
            </p>
            
            <div class="architecture-diagram">
                <div class="diagram-container">
                    <div class="diagram-component frontend">
                        <div class="icon">
                            <i class="fas fa-desktop"></i>
                        </div>
                        <h5>Frontend</h5>
                        <p>Interface do usuário responsiva</p>
                    </div>
                    
                    <div class="diagram-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    
                    <div class="diagram-component api">
                        <div class="icon">
                            <i class="fab fa-laravel"></i>
                        </div>
                        <h5>API Laravel</h5>
                        <p>Lógica de negócio e endpoints</p>
                    </div>
                    
                    <div class="diagram-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    
                    <div class="diagram-component cache">
                        <div class="icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h5>Redis Cache</h5>
                        <p>Cache e sessões</p>
                    </div>
                    
                    <div class="diagram-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    
                    <div class="diagram-component database">
                        <div class="icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h5>MongoDB</h5>
                        <p>Armazenamento persistente</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h4><i class="fas fa-cogs"></i> Fluxo de Dados</h4>
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item">Usuário envia URL através do frontend</li>
                        <li class="list-group-item">Laravel processa e valida a requisição</li>
                        <li class="list-group-item">Sistema verifica cache Redis primeiro</li>
                        <li class="list-group-item">Se não encontrado, consulta MongoDB</li>
                        <li class="list-group-item">Resultado é cacheado no Redis</li>
                        <li class="list-group-item">Resposta é enviada ao usuário</li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <h4><i class="fas fa-shield-alt"></i> Segurança e Performance</h4>
                    <ul class="list-group">
                        <li class="list-group-item">Rate limiting com Redis</li>
                        <li class="list-group-item">Validação de URLs maliciosas</li>
                        <li class="list-group-item">Cache inteligente para URLs</li>
                        <li class="list-group-item">Monitoramento em tempo real</li>
                        <li class="list-group-item">Backup automático de dados</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Performance Stats -->
    <section class="stats-section">
        <div class="container">
            <h2 class="section-title">Performance em Números</h2>
            <p class="section-subtitle">
                Resultados impressionantes graças à nossa stack tecnológica otimizada
            </p>
            
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="stat-card">
                        <div class="stat-number" data-target="100">0</div>
                        <div class="stat-label">ms</div>
                        <p class="mt-2">Tempo médio de resposta</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stat-card">
                        <div class="stat-number" data-target="99.9">0</div>
                        <div class="stat-label">%</div>
                        <p class="mt-2">Uptime garantido</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stat-card">
                        <div class="stat-number" data-target="10000">0</div>
                        <div class="stat-label">req/s</div>
                        <p class="mt-2">Requisições por segundo</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stat-card">
                        <div class="stat-number" data-target="95">0</div>
                        <div class="stat-label">%</div>
                        <p class="mt-2">Cache hit rate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section">
        <div class="container">
            <h2 class="section-title text-white">Por que Escolhemos Esta Stack?</h2>
            <p class="section-subtitle text-white opacity-75">
                Cada tecnologia foi selecionada para maximizar performance, segurança e escalabilidade
            </p>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <div class="benefit-content">
                            <h5>Performance Excepcional</h5>
                            <p>Redis cache e MongoDB otimizado garantem respostas ultra-rápidas mesmo com milhões de URLs.</p>
                        </div>
                    </div>
                    
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </div>
                        <div class="benefit-content">
                            <h5>Escalabilidade Infinita</h5>
                            <p>Docker e MongoDB permitem escalar horizontalmente conforme a demanda cresce.</p>
                        </div>
                    </div>
                    
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="benefit-content">
                            <h5>Desenvolvimento Ágil</h5>
                            <p>Laravel acelera o desenvolvimento com ferramentas modernas e código expressivo.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="benefit-content">
                            <h5>Segurança Robusta</h5>
                            <p>Múltiplas camadas de segurança protegem contra ataques e garantem integridade dos dados.</p>
                        </div>
                    </div>
                    
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="benefit-content">
                            <h5>Manutenção Simplificada</h5>
                            <p>Docker containers facilitam atualizações e manutenção sem downtime.</p>
                        </div>
                    </div>
                    
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="benefit-content">
                            <h5>Analytics Avançados</h5>
                            <p>MongoDB permite análises complexas de dados para insights valiosos sobre uso.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animated counters
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const increment = target / 100;
                let current = 0;
                
                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        if (target >= 1000) {
                            counter.textContent = Math.floor(current).toLocaleString();
                        } else {
                            counter.textContent = Math.floor(current * 10) / 10;
                        }
                        requestAnimationFrame(updateCounter);
                    } else {
                        if (target >= 1000) {
                            counter.textContent = target.toLocaleString();
                        } else {
                            counter.textContent = target;
                        }
                    }
                };
                
                updateCounter();
            });
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.3,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.classList.contains('stats-section')) {
                        animateCounters();
                    }
                    
                    // Animate tech cards
                    const techCards = entry.target.querySelectorAll('.tech-card');
                    techCards.forEach((card, index) => {
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, index * 200);
                    });
                    
                    // Animate benefit items
                    const benefitItems = entry.target.querySelectorAll('.benefit-item');
                    benefitItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'translateX(0)';
                        }, index * 150);
                    });
                }
            });
        }, observerOptions);

        // Observe sections for animations
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('.tech-overview, .stats-section, .benefits-section');
            sections.forEach(section => observer.observe(section));
            
            // Initial setup for animated elements
            const techCards = document.querySelectorAll('.tech-card');
            techCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            });
            
            const benefitItems = document.querySelectorAll('.benefit-item');
            benefitItems.forEach(item => {
                item.style.opacity = '0';
                item.style.transform = 'translateX(-30px)';
                item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            });
        });

        // Smooth scrolling for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Interactive diagram components
        document.querySelectorAll('.diagram-component').forEach(component => {
            component.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.1) rotate(2deg)';
            });
            
            component.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1) rotate(0deg)';
            });
        });

        // Parallax effect for floating elements
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelectorAll('.floating-element');
            
            parallax.forEach((element, index) => {
                const speed = 0.5 + (index * 0.2);
                element.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.1}deg)`;
            });
        });
    </script>
</body>
</html>

