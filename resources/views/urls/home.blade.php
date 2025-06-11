<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener - Encurte suas URLs facilmente</title>
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
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, var(--dark-bg) 0%, #1e293b 100%);
            min-height: 100vh;
            color: white;
        }

        .navbar {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--accent-color) !important;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
        }

        .navbar-nav .nav-link:hover {
            color: var(--accent-color) !important;
            transform: translateY(-1px);
        }

        .hero-section {
            padding: 8rem 0 4rem;
            text-align: center;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .url-shortener-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 700px;
            margin: 0 auto;
        }

        .url-shortener-card h3 {
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .url-shortener-card p {
            color: var(--text-light);
            margin-bottom: 2rem;
        }

        .url-input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .url-input {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .url-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
            outline: none;
        }

        .shorten-btn {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
        }

        .shorten-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 64, 175, 0.4);
        }

        .result-section {
            margin-top: 2rem;
            padding: 1.5rem;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            display: none;
        }

        .shortened-url {
            font-family: 'Monaco', 'Menlo', monospace;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1rem;
            margin: 1rem 0;
            word-break: break-all;
            color: var(--primary-color);
            font-weight: 600;
        }

        .copy-btn {
            background: var(--accent-color);
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .copy-btn:hover {
            background: #d97706;
            transform: translateY(-1px);
        }

        .features-section {
            padding: 6rem 0;
            background: rgba(255, 255, 255, 0.05);
            margin-top: 4rem;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--accent-color);
            margin-bottom: 1rem;
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .feature-description {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
        }

        .footer {
            background: var(--dark-bg);
            padding: 3rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 4rem;
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .url-shortener-card {
                padding: 2rem;
                margin: 0 1rem;
            }
        }

        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid #ffffff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .alert-custom {
            border-radius: 12px;
            border: none;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-link"></i> URLShort</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('api_docs')}}">API</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('benchmark')}}">Tecnologias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('technologies')}}">Benchmark</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <h1 class="hero-title">Encurte suas URLs com facilidade</h1>
            <p class="hero-subtitle">
                Transforme links longos em URLs curtas e elegantes. Monitore cliques, 
                gerencie seus links e melhore a experiência do usuário.
            </p>

            <!-- URL Shortener Card -->
            <div class="url-shortener-card">
                <h3><i class="fas fa-scissors"></i> Encurtar Link</h3>
                <p>Cole sua URL longa aqui e obtenha um link curto instantaneamente</p>
                
                <form id="shortenForm">
                    <div class="url-input-group">
                        <input type="url" 
                               class="form-control url-input" 
                               id="longUrl" 
                               placeholder="https://exemplo.com/minha-url-muito-longa"
                               required>
                    </div>
                    <button type="submit" class="btn shorten-btn w-100">
                        <span class="btn-text">
                            <i class="fas fa-magic"></i> Encurtar URL
                        </span>
                        <div class="loading-spinner"></div>
                    </button>
                </form>

                <!-- Result Section -->
                <div class="result-section" id="resultSection">
                    <h5><i class="fas fa-check-circle text-success"></i> URL Encurtada com Sucesso!</h5>
                    <div class="shortened-url" id="shortenedUrl"></div>
                    <div class="d-flex gap-2 flex-wrap">
                        <button class="btn copy-btn" onclick="copyToClipboard()">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                        <button class="btn btn-outline-primary" onclick="visitUrl()">
                            <i class="fas fa-external-link-alt"></i> Visitar
                        </button>
                        <button class="btn btn-outline-secondary" onclick="resetForm()">
                            <i class="fas fa-redo"></i> Nova URL
                        </button>
                    </div>
                </div>

                <!-- Alert Section -->
                <div id="alertSection"></div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4 class="feature-title">Rápido e Eficiente</h4>
                        <p class="feature-description">
                            Encurte suas URLs em segundos com nossa API otimizada 
                            e interface intuitiva.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4 class="feature-title">Analytics Detalhados</h4>
                        <p class="feature-description">
                            Monitore cliques, localizações e dispositivos com 
                            relatórios completos e em tempo real.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="feature-title">Seguro e Confiável</h4>
                        <p class="feature-description">
                            Seus links são protegidos com criptografia avançada 
                            e monitoramento de segurança 24/7.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-text">
                <p>&copy; 2024 URLShort. Desenvolvido com <i class="fas fa-heart text-danger"></i> usando Laravel, Docker, MongoDB e Redis.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let shortenedUrlData = null;

        // Form submission handler
        document.getElementById('shortenForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const longUrl = document.getElementById('longUrl').value;
            const submitBtn = document.querySelector('.shorten-btn');
            const btnText = submitBtn.querySelector('.btn-text');
            const spinner = submitBtn.querySelector('.loading-spinner');
            
            // Show loading state
            btnText.style.display = 'none';
            spinner.style.display = 'inline-block';
            submitBtn.disabled = true;
            
            // Clear previous results
            document.getElementById('resultSection').style.display = 'none';
            document.getElementById('alertSection').innerHTML = '';
            
            try {
                // Simulate API call (replace with actual API endpoint)
                await new Promise(resolve => setTimeout(resolve, 1500));
                
                // Mock response (replace with actual API call)
                const response = {
                    success: true,
                    shortUrl: 'https://urlshort.dev/' + generateShortCode(),
                    originalUrl: longUrl,
                    clicks: 0,
                    createdAt: new Date().toISOString()
                };
                
                if (response.success) {
                    shortenedUrlData = response;
                    document.getElementById('shortenedUrl').textContent = response.shortUrl;
                    document.getElementById('resultSection').style.display = 'block';
                    
                    // Scroll to result
                    document.getElementById('resultSection').scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                } else {
                    showAlert('Erro ao encurtar URL. Tente novamente.', 'danger');
                }
                
            } catch (error) {
                console.error('Error:', error);
                showAlert('Erro de conexão. Verifique sua internet e tente novamente.', 'danger');
            } finally {
                // Reset button state
                btnText.style.display = 'inline';
                spinner.style.display = 'none';
                submitBtn.disabled = false;
            }
        });

        // Generate random short code (for demo purposes)
        function generateShortCode() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < 6; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return result;
        }

        // Copy to clipboard function
        async function copyToClipboard() {
            if (!shortenedUrlData) return;
            
            try {
                await navigator.clipboard.writeText(shortenedUrlData.shortUrl);
                showAlert('URL copiada para a área de transferência!', 'success');
            } catch (err) {
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = shortenedUrlData.shortUrl;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                showAlert('URL copiada para a área de transferência!', 'success');
            }
        }

        // Visit URL function
        function visitUrl() {
            if (!shortenedUrlData) return;
            window.open(shortenedUrlData.shortUrl, '_blank');
        }

        // Reset form function
        function resetForm() {
            document.getElementById('shortenForm').reset();
            document.getElementById('resultSection').style.display = 'none';
            document.getElementById('alertSection').innerHTML = '';
            shortenedUrlData = null;
        }

        // Show alert function
        function showAlert(message, type) {
            const alertSection = document.getElementById('alertSection');
            const alertHtml = `
                <div class="alert alert-${type} alert-custom alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            alertSection.innerHTML = alertHtml;
            
            // Auto dismiss after 5 seconds
            setTimeout(() => {
                const alert = alertSection.querySelector('.alert');
                if (alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        }

        // Smooth scrolling for navigation links
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

        // Add some interactive animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate feature cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.feature-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
</body>
</html>

