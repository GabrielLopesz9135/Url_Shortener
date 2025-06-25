<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentação da API - URL Shortener</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">
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
            padding: 4rem 0;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .main-content {
            padding: 4rem 0;
        }

        .sidebar {
            position: sticky;
            top: 2rem;
            height: fit-content;
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .sidebar h5 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
        }

        .sidebar-nav li {
            margin-bottom: 0.5rem;
        }

        .sidebar-nav a {
            color: var(--text-light);
            text-decoration: none;
            display: block;
            padding: 0.5rem 0;
            border-left: 3px solid transparent;
            padding-left: 1rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            color: var(--primary-color);
            border-left-color: var(--primary-color);
            background: rgba(30, 64, 175, 0.05);
            margin-left: -1rem;
            padding-left: 2rem;
        }

        .content-section {
            background: white;
            border-radius: 12px;
            padding: 3rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            border-bottom: 3px solid var(--primary-color);
            padding-bottom: 0.5rem;
        }

        .endpoint-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .endpoint-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .http-method {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.875rem;
            text-transform: uppercase;
        }

        .method-get { background: var(--success-color); color: white; }
        .method-post { background: var(--primary-color); color: white; }
        .method-put { background: var(--warning-color); color: white; }
        .method-delete { background: var(--danger-color); color: white; }

        .endpoint-url {
            font-family: 'Monaco', 'Menlo', monospace;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            flex: 1;
            min-width: 300px;
        }

        .endpoint-description {
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .params-table {
            margin-bottom: 1.5rem;
        }

        .params-table th {
            background: var(--primary-color);
            color: white;
            border: none;
            font-weight: 600;
        }

        .params-table td {
            border-color: #e2e8f0;
        }

        .param-type {
            font-family: 'Monaco', 'Menlo', monospace;
            background: #f1f5f9;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .param-required {
            color: var(--danger-color);
            font-weight: 700;
        }

        .param-optional {
            color: var(--text-light);
        }

        .code-block {
            background: #1e293b;
            border-radius: 8px;
            padding: 1.5rem;
            margin: 1rem 0;
            overflow-x: auto;
        }

        .code-block pre {
            margin: 0;
            color: #e2e8f0;
        }

        .code-tabs {
            display: flex;
            background: #f1f5f9;
            border-radius: 8px 8px 0 0;
            border: 1px solid #e2e8f0;
            border-bottom: none;
        }

        .code-tab {
            padding: 0.75rem 1.5rem;
            background: transparent;
            border: none;
            cursor: pointer;
            font-weight: 600;
            color: var(--text-light);
            transition: all 0.3s ease;
        }

        .code-tab.active {
            background: var(--primary-color);
            color: white;
        }

        .code-content {
            display: none;
        }

        .code-content.active {
            display: block;
        }

        .response-example {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 1rem;
        }

        .response-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .status-200 { background: var(--success-color); color: white; }
        .status-400 { background: var(--warning-color); color: white; }
        .status-404 { background: var(--danger-color); color: white; }
        .status-500 { background: #6b7280; color: white; }

        .try-it-btn {
            background: var(--accent-color);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .try-it-btn:hover {
            background: #d97706;
            transform: translateY(-1px);
        }

        .auth-info {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .auth-info h6 {
            color: #92400e;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .auth-info p {
            color: #92400e;
            margin: 0;
        }

        .rate-limit-info {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border: 1px solid var(--primary-color);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .rate-limit-info h6 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .rate-limit-info p {
            color: var(--primary-color);
            margin: 0;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .content-section {
                padding: 2rem;
            }
            
            .sidebar {
                position: static;
                margin-bottom: 2rem;
            }
            
            .endpoint-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .endpoint-url {
                min-width: 100%;
            }
        }

        .copy-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .copy-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .code-block {
            position: relative;
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
                        <a class="nav-link" href="{{route('url.clicks')}}">Estatísticas de Click</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('api_docs')}}">API</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('technologies')}}">Tecnologias</a>
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
        <div class="container">
            <h1 class="hero-title"><i class="fas fa-code"></i> Documentação da API</h1>
            <p class="hero-subtitle">
                Integre nosso encurtador de URLs em suas aplicações com nossa API RESTful completa e fácil de usar.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="main-content">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3">
                    <div class="sidebar">
                        <h5><i class="fas fa-list"></i> Navegação</h5>
                        <ul class="sidebar-nav">
                            <li><a href="#getting-started" class="active">Começando</a></li>
                            <li><a href="#authentication">Autenticação</a></li>
                            <li><a href="#rate-limits">Rate Limits</a></li>
                            <li><a href="#endpoints">Endpoints</a></li>
                            <li><a href="#shorten-url">Encurtar URL</a></li>
                            <li><a href="#get-url">Obter URL</a></li>
                            <li><a href="#list-urls">Listar URLs</a></li>
                            <li><a href="#update-url">Atualizar URL</a></li>
                            <li><a href="#delete-url">Deletar URL</a></li>
                            <li><a href="#analytics">Analytics</a></li>
                            <li><a href="#errors">Códigos de Erro</a></li>
                            <li><a href="#sdks">SDKs</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Content -->
                <div class="col-lg-9">
                    <!-- Getting Started -->
                    <div class="content-section" id="getting-started">
                        <h2 class="section-title">Começando</h2>
                        <p>Nossa API RESTful permite que você integre facilmente o encurtamento de URLs em suas aplicações. Todos os endpoints retornam dados em formato JSON e seguem os padrões REST.</p>
                        
                        <h4>URL Base</h4>
                        <div class="code-block">
                            <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                            <pre><code>https://api.urlshort.dev/v1</code></pre>
                        </div>

                        <h4>Formato de Resposta</h4>
                        <p>Todas as respostas da API seguem um formato consistente:</p>
                        <div class="code-block">
                            <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                            <pre><code>{
  "success": true,
  "data": {
    // dados da resposta
  },
  "message": "Operação realizada com sucesso",
  "timestamp": "2024-01-15T10:30:00Z"
}</code></pre>
                        </div>
                    </div>

                    <!-- Authentication -->
                    <div class="content-section" id="authentication">
                        <h2 class="section-title">Autenticação</h2>
                        
                        <div class="auth-info">
                            <h6><i class="fas fa-key"></i> API Key Obrigatória</h6>
                            <p>Todos os endpoints requerem autenticação via API Key no header da requisição.</p>
                        </div>

                        <p>Para autenticar suas requisições, inclua sua API Key no header <code>Authorization</code>:</p>
                        
                        <div class="code-tabs">
                            <button class="code-tab active" onclick="showTab(event, 'auth-curl')">cURL</button>
                            <button class="code-tab" onclick="showTab(event, 'auth-js')">JavaScript</button>
                            <button class="code-tab" onclick="showTab(event, 'auth-php')">PHP</button>
                            <button class="code-tab" onclick="showTab(event, 'auth-python')">Python</button>
                        </div>

                        <div id="auth-curl" class="code-content active">
                            <div class="code-block">
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                <pre><code>curl -H "Authorization: Bearer YOUR_API_KEY" \
     -H "Content-Type: application/json" \
     https://api.urlshort.dev/v1/urls</code></pre>
                            </div>
                        </div>

                        <div id="auth-js" class="code-content">
                            <div class="code-block">
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                <pre><code>const response = await fetch('https://api.urlshort.dev/v1/urls', {
  headers: {
    'Authorization': 'Bearer YOUR_API_KEY',
    'Content-Type': 'application/json'
  }
});</code></pre>
                            </div>
                        </div>

                        <div id="auth-php" class="code-content">
                            <div class="code-block">
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                <pre><code>$headers = [
    'Authorization: Bearer YOUR_API_KEY',
    'Content-Type: application/json'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_URL, 'https://api.urlshort.dev/v1/urls');</code></pre>
                            </div>
                        </div>

                        <div id="auth-python" class="code-content">
                            <div class="code-block">
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                <pre><code>import requests

headers = {
    'Authorization': 'Bearer YOUR_API_KEY',
    'Content-Type': 'application/json'
}

response = requests.get('https://api.urlshort.dev/v1/urls', headers=headers)</code></pre>
                            </div>
                        </div>
                    </div>

                    <!-- Rate Limits -->
                    <div class="content-section" id="rate-limits">
                        <h2 class="section-title">Rate Limits</h2>
                        
                        <div class="rate-limit-info">
                            <h6><i class="fas fa-tachometer-alt"></i> Limites de Taxa</h6>
                            <p>Para garantir a qualidade do serviço, aplicamos limites de taxa em nossa API.</p>
                        </div>

                        <table class="table params-table">
                            <thead>
                                <tr>
                                    <th>Plano</th>
                                    <th>Requisições/Minuto</th>
                                    <th>Requisições/Dia</th>
                                    <th>URLs/Mês</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Gratuito</strong></td>
                                    <td>60</td>
                                    <td>1.000</td>
                                    <td>1.000</td>
                                </tr>
                                <tr>
                                    <td><strong>Pro</strong></td>
                                    <td>300</td>
                                    <td>10.000</td>
                                    <td>50.000</td>
                                </tr>
                                <tr>
                                    <td><strong>Enterprise</strong></td>
                                    <td>1.000</td>
                                    <td>100.000</td>
                                    <td>Ilimitado</td>
                                </tr>
                            </tbody>
                        </table>

                        <h4>Headers de Rate Limit</h4>
                        <p>Cada resposta da API inclui headers informativos sobre seus limites:</p>
                        <div class="code-block">
                            <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                            <pre><code>X-RateLimit-Limit: 60
X-RateLimit-Remaining: 58
X-RateLimit-Reset: 1642248600</code></pre>
                        </div>
                    </div>

                    <!-- Shorten URL -->
                    <div class="content-section" id="shorten-url">
                        <h2 class="section-title">Encurtar URL</h2>
                        
                        <div class="endpoint-card">
                            <div class="endpoint-header">
                                <span class="http-method method-post">POST</span>
                                <code class="endpoint-url">/urls</code>
                            </div>
                            <p class="endpoint-description">Cria uma nova URL encurtada a partir de uma URL longa.</p>

                            <h5>Parâmetros</h5>
                            <table class="table params-table">
                                <thead>
                                    <tr>
                                        <th>Parâmetro</th>
                                        <th>Tipo</th>
                                        <th>Obrigatório</th>
                                        <th>Descrição</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>url</code></td>
                                        <td><span class="param-type">string</span></td>
                                        <td><span class="param-required">Sim</span></td>
                                        <td>A URL longa que será encurtada</td>
                                    </tr>
                                    <tr>
                                        <td><code>custom_code</code></td>
                                        <td><span class="param-type">string</span></td>
                                        <td><span class="param-optional">Não</span></td>
                                        <td>Código personalizado para a URL (3-20 caracteres)</td>
                                    </tr>
                                    <tr>
                                        <td><code>title</code></td>
                                        <td><span class="param-type">string</span></td>
                                        <td><span class="param-optional">Não</span></td>
                                        <td>Título descritivo para a URL</td>
                                    </tr>
                                    <tr>
                                        <td><code>expires_at</code></td>
                                        <td><span class="param-type">datetime</span></td>
                                        <td><span class="param-optional">Não</span></td>
                                        <td>Data de expiração da URL (ISO 8601)</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h5>Exemplo de Requisição</h5>
                            <div class="code-tabs">
                                <button class="code-tab active" onclick="showTab(event, 'shorten-curl')">cURL</button>
                                <button class="code-tab" onclick="showTab(event, 'shorten-js')">JavaScript</button>
                                <button class="code-tab" onclick="showTab(event, 'shorten-php')">PHP</button>
                            </div>

                            <div id="shorten-curl" class="code-content active">
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                    <pre><code>curl -X POST https://api.urlshort.dev/v1/urls \
  -H "Authorization: Bearer YOUR_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "url": "https://exemplo.com/minha-url-muito-longa",
    "title": "Minha URL Personalizada",
    "custom_code": "meulink"
  }'</code></pre>
                                </div>
                            </div>

                            <div id="shorten-js" class="code-content">
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                    <pre><code>const response = await fetch('https://api.urlshort.dev/v1/urls', {
  method: 'POST',
  headers: {
    'Authorization': 'Bearer YOUR_API_KEY',
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    url: 'https://exemplo.com/minha-url-muito-longa',
    title: 'Minha URL Personalizada',
    custom_code: 'meulink'
  })
});

const data = await response.json();</code></pre>
                                </div>
                            </div>

                            <div id="shorten-php" class="code-content">
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                    <pre><code>$data = [
    'url' => 'https://exemplo.com/minha-url-muito-longa',
    'title' => 'Minha URL Personalizada',
    'custom_code' => 'meulink'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.urlshort.dev/v1/urls');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer YOUR_API_KEY',
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);</code></pre>
                                </div>
                            </div>

                            <h5>Resposta de Sucesso</h5>
                            <div class="response-example">
                                <span class="response-status status-200">200 OK</span>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                    <pre><code>{
  "success": true,
  "data": {
    "id": "64f8a1b2c3d4e5f6a7b8c9d0",
    "short_url": "https://urlshort.dev/meulink",
    "original_url": "https://exemplo.com/minha-url-muito-longa",
    "custom_code": "meulink",
    "title": "Minha URL Personalizada",
    "clicks": 0,
    "created_at": "2024-01-15T10:30:00Z",
    "expires_at": null,
    "is_active": true
  },
  "message": "URL encurtada com sucesso",
  "timestamp": "2024-01-15T10:30:00Z"
}</code></pre>
                                </div>
                            </div>

                            <button class="try-it-btn" onclick="tryEndpoint('shorten')">
                                <i class="fas fa-play"></i> Testar Endpoint
                            </button>
                        </div>
                    </div>

                    <!-- Get URL -->
                    <div class="content-section" id="get-url">
                        <h2 class="section-title">Obter URL</h2>
                        
                        <div class="endpoint-card">
                            <div class="endpoint-header">
                                <span class="http-method method-get">GET</span>
                                <code class="endpoint-url">/urls/{id}</code>
                            </div>
                            <p class="endpoint-description">Obtém informações detalhadas de uma URL específica.</p>

                            <h5>Parâmetros de URL</h5>
                            <table class="table params-table">
                                <thead>
                                    <tr>
                                        <th>Parâmetro</th>
                                        <th>Tipo</th>
                                        <th>Descrição</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>id</code></td>
                                        <td><span class="param-type">string</span></td>
                                        <td>ID único da URL ou código personalizado</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h5>Exemplo de Requisição</h5>
                            <div class="code-block">
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                <pre><code>curl -H "Authorization: Bearer YOUR_API_KEY" \
     https://api.urlshort.dev/v1/urls/meulink</code></pre>
                            </div>

                            <h5>Resposta de Sucesso</h5>
                            <div class="response-example">
                                <span class="response-status status-200">200 OK</span>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                    <pre><code>{
  "success": true,
  "data": {
    "id": "64f8a1b2c3d4e5f6a7b8c9d0",
    "short_url": "https://urlshort.dev/meulink",
    "original_url": "https://exemplo.com/minha-url-muito-longa",
    "custom_code": "meulink",
    "title": "Minha URL Personalizada",
    "clicks": 127,
    "created_at": "2024-01-15T10:30:00Z",
    "updated_at": "2024-01-15T14:22:00Z",
    "expires_at": null,
    "is_active": true,
    "analytics": {
      "total_clicks": 127,
      "unique_clicks": 89,
      "clicks_today": 12,
      "clicks_this_week": 45
    }
  },
  "message": "URL encontrada",
  "timestamp": "2024-01-15T15:45:00Z"
}</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Analytics -->
                    <div class="content-section" id="analytics">
                        <h2 class="section-title">Analytics</h2>
                        
                        <div class="endpoint-card">
                            <div class="endpoint-header">
                                <span class="http-method method-get">GET</span>
                                <code class="endpoint-url">/urls/{id}/analytics</code>
                            </div>
                            <p class="endpoint-description">Obtém estatísticas detalhadas de cliques e analytics de uma URL.</p>

                            <h5>Parâmetros de Query</h5>
                            <table class="table params-table">
                                <thead>
                                    <tr>
                                        <th>Parâmetro</th>
                                        <th>Tipo</th>
                                        <th>Padrão</th>
                                        <th>Descrição</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>period</code></td>
                                        <td><span class="param-type">string</span></td>
                                        <td>7d</td>
                                        <td>Período: 1d, 7d, 30d, 90d, 1y</td>
                                    </tr>
                                    <tr>
                                        <td><code>timezone</code></td>
                                        <td><span class="param-type">string</span></td>
                                        <td>UTC</td>
                                        <td>Timezone para os dados (ex: America/Sao_Paulo)</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h5>Resposta de Sucesso</h5>
                            <div class="response-example">
                                <span class="response-status status-200">200 OK</span>
                                <div class="code-block">
                                    <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                    <pre><code>{
  "success": true,
  "data": {
    "summary": {
      "total_clicks": 1247,
      "unique_clicks": 892,
      "period_clicks": 156,
      "click_through_rate": 12.5
    },
    "timeline": [
      {
        "date": "2024-01-15",
        "clicks": 23,
        "unique_clicks": 18
      }
    ],
    "countries": [
      {
        "country": "Brazil",
        "country_code": "BR",
        "clicks": 89,
        "percentage": 57.1
      }
    ],
    "referrers": [
      {
        "referrer": "google.com",
        "clicks": 45,
        "percentage": 28.8
      }
    ],
    "devices": [
      {
        "device": "mobile",
        "clicks": 98,
        "percentage": 62.8
      }
    ]
  },
  "message": "Analytics obtidos com sucesso",
  "timestamp": "2024-01-15T15:45:00Z"
}</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Error Codes -->
                    <div class="content-section" id="errors">
                        <h2 class="section-title">Códigos de Erro</h2>
                        
                        <p>Nossa API utiliza códigos de status HTTP convencionais para indicar sucesso ou falha de uma requisição.</p>

                        <table class="table params-table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Status</th>
                                    <th>Descrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="response-status status-200">200</span></td>
                                    <td>OK</td>
                                    <td>Requisição processada com sucesso</td>
                                </tr>
                                <tr>
                                    <td><span class="response-status status-400">400</span></td>
                                    <td>Bad Request</td>
                                    <td>Parâmetros inválidos ou ausentes</td>
                                </tr>
                                <tr>
                                    <td><span class="response-status status-400">401</span></td>
                                    <td>Unauthorized</td>
                                    <td>API Key inválida ou ausente</td>
                                </tr>
                                <tr>
                                    <td><span class="response-status status-400">403</span></td>
                                    <td>Forbidden</td>
                                    <td>Acesso negado ou limite excedido</td>
                                </tr>
                                <tr>
                                    <td><span class="response-status status-404">404</span></td>
                                    <td>Not Found</td>
                                    <td>Recurso não encontrado</td>
                                </tr>
                                <tr>
                                    <td><span class="response-status status-400">429</span></td>
                                    <td>Too Many Requests</td>
                                    <td>Rate limit excedido</td>
                                </tr>
                                <tr>
                                    <td><span class="response-status status-500">500</span></td>
                                    <td>Internal Server Error</td>
                                    <td>Erro interno do servidor</td>
                                </tr>
                            </tbody>
                        </table>

                        <h4>Formato de Erro</h4>
                        <div class="response-example">
                            <span class="response-status status-400">400 Bad Request</span>
                            <div class="code-block">
                                <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                <pre><code>{
  "success": false,
  "error": {
    "code": "INVALID_URL",
    "message": "A URL fornecida não é válida",
    "details": "A URL deve começar com http:// ou https://"
  },
  "timestamp": "2024-01-15T15:45:00Z"
}</code></pre>
                            </div>
                        </div>
                    </div>

                    <!-- SDKs -->
                    <div class="content-section" id="sdks">
                        <h2 class="section-title">SDKs e Bibliotecas</h2>
                        
                        <p>Para facilitar a integração, oferecemos SDKs oficiais para as principais linguagens de programação:</p>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="endpoint-card">
                                    <h5><i class="fab fa-js-square text-warning"></i> JavaScript/Node.js</h5>
                                    <div class="code-block">
                                        <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                        <pre><code>npm install urlshort-sdk</code></pre>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="endpoint-card">
                                    <h5><i class="fab fa-php text-primary"></i> PHP</h5>
                                    <div class="code-block">
                                        <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                        <pre><code>composer require urlshort/php-sdk</code></pre>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="endpoint-card">
                                    <h5><i class="fab fa-python text-success"></i> Python</h5>
                                    <div class="code-block">
                                        <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                        <pre><code>pip install urlshort-python</code></pre>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="endpoint-card">
                                    <h5><i class="fab fa-java text-danger"></i> Java</h5>
                                    <div class="code-block">
                                        <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                                        <pre><code>implementation 'com.urlshort:java-sdk:1.0.0'</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4>Exemplo com JavaScript SDK</h4>
                        <div class="code-block">
                            <button class="copy-btn" onclick="copyCode(this)"><i class="fas fa-copy"></i></button>
                            <pre><code>import URLShort from 'urlshort-sdk';

const client = new URLShort('YOUR_API_KEY');

// Encurtar URL
const result = await client.shorten({
  url: 'https://exemplo.com/minha-url-longa',
  title: 'Minha URL'
});

console.log(result.short_url); // https://urlshort.dev/abc123

// Obter analytics
const analytics = await client.getAnalytics(result.id, {
  period: '7d'
});

console.log(analytics.summary.total_clicks);</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js"></script>
    <script>
        // Tab switching functionality
        function showTab(event, tabId) {
            // Hide all tab contents in the same parent
            const parent = event.target.closest('.endpoint-card') || event.target.closest('.content-section');
            const tabContents = parent.querySelectorAll('.code-content');
            const tabButtons = parent.querySelectorAll('.code-tab');
            
            tabContents.forEach(content => content.classList.remove('active'));
            tabButtons.forEach(button => button.classList.remove('active'));
            
            // Show selected tab
            document.getElementById(tabId).classList.add('active');
            event.target.classList.add('active');
        }

        // Copy code functionality
        async function copyCode(button) {
            const codeBlock = button.nextElementSibling;
            const code = codeBlock.textContent;
            
            try {
                await navigator.clipboard.writeText(code);
                
                // Visual feedback
                const originalIcon = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i>';
                button.style.background = 'rgba(16, 185, 129, 0.2)';
                
                setTimeout(() => {
                    button.innerHTML = originalIcon;
                    button.style.background = 'rgba(255, 255, 255, 0.1)';
                }, 2000);
                
            } catch (err) {
                console.error('Failed to copy code:', err);
            }
        }

        // Sidebar navigation
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarLinks = document.querySelectorAll('.sidebar-nav a');
            const sections = document.querySelectorAll('.content-section');
            
            // Smooth scrolling
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetSection = document.getElementById(targetId);
                    
                    if (targetSection) {
                        targetSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Active section highlighting
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            const id = entry.target.id;
                            sidebarLinks.forEach(link => {
                                link.classList.remove('active');
                                if (link.getAttribute('href') === `#${id}`) {
                                    link.classList.add('active');
                                }
                            });
                        }
                    });
                },
                { threshold: 0.3, rootMargin: '-100px 0px -50% 0px' }
            );

            sections.forEach(section => observer.observe(section));
        });

        // Try endpoint functionality (placeholder)
        function tryEndpoint(endpoint) {
            alert(`Funcionalidade "Testar ${endpoint}" será implementada em breve!`);
        }

        // Syntax highlighting for code blocks
        document.addEventListener('DOMContentLoaded', function() {
            Prism.highlightAll();
        });
    </script>
</body>
</html>

