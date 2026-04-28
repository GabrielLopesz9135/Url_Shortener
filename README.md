# Url Shortener

## Descrição
Serviço de encurtamento de URLs com API pública e painel web simples. Armazena URLs em MongoDB, usa Redis para cache e contadores, e filas para sincronização de métricas.

## Funcionalidades principais
- Encurtamento de URLs (web e API).
- Redirecionamento para a URL original.
- Estatísticas por short code (clicks, criação, expiração).
- Autenticação por API key via middleware `ValidateApiHeaders`.
- Rate limiting diário por plano via middleware `RateLimitByPlan`.
- Cache em Redis com TTL para reduzir leituras ao MongoDB.

## Estrutura e arquitetura
Padrão MVC com camadas adicionais de Repositório e Service, separando responsabilidades e facilitando testes:

- Controllers: [app/Http/Controllers/PublicUrlController.php](app/Http/Controllers/PublicUrlController.php), [app/Http/Controllers/api/UrlController.php](app/Http/Controllers/api/UrlController.php)
- Services: [app/Services/UrlService.php](app/Services/UrlService.php), [app/Services/PublicUrlService.php](app/Services/PublicUrlService.php)
- Repositórios: [app/Repositories/UrlRepositoryEloquent.php](app/Repositories/UrlRepositoryEloquent.php), [app/Repositories/PublicUrlRepositoryEloquent.php](app/Repositories/PublicUrlRepositoryEloquent.php)
- Models (MongoDB): [app/Models/Url.php](app/Models/Url.php), [app/Models/User.php](app/Models/User.php), [app/Models/Plan.php](app/Models/Plan.php)
- Eventos: [app/Events/UrlVisited.php](app/Events/UrlVisited.php)
- Listeners: [app/Listeners/IncrementUrlClicks.php](app/Listeners/IncrementUrlClicks.php)
- Jobs / Filas: [app/Jobs/SyncUrlClicks.php](app/Jobs/SyncUrlClicks.php)

Essa separação permite manter regras de negócio nos serviços, persistência nos repositórios e responsabilidade de I/O nos controllers.

## Eventos, Listeners e Jobs
- Evento `UrlVisited` dispara quando uma visita ocorre (arquivo: [app/Events/UrlVisited.php](app/Events/UrlVisited.php)).
- Listener `IncrementUrlClicks` atualiza o contador de cliques no MongoDB de forma assíncrona/reativa (arquivo: [app/Listeners/IncrementUrlClicks.php](app/Listeners/IncrementUrlClicks.php)).
- Job `SyncUrlClicks` varre chaves em Redis (`clicks:*`), aplica incrementos no MongoDB e remove as chaves do Redis para persistência eventual (arquivo: [app/Jobs/SyncUrlClicks.php](app/Jobs/SyncUrlClicks.php)). Rode consumidores com `php artisan queue:work` ou agende o job via `schedule`.

## Cache e contadores
- Ao criar um short code, o serviço grava `short_code => original_url` em Redis com TTL via `Redis::setex`.
- Na resolução, o serviço tenta ler de Redis antes de consultar MongoDB; se faltar, carrega do MongoDB e popula Redis novamente.
- Cliques são incrementados em Redis com chave `clicks:{short_code}` (operações rápidas e menos gravações no Mongo). Periodicamente `SyncUrlClicks` consolida esses valores no MongoDB.
- Rate limiting por usuário/planos é implementado com chave `rate_limit:{api_key}:{date}` e é decrementado atomically para limitar requisições diárias.

## Escalabilidade e operação
- Cache + contadores em Redis reduzem I/O no MongoDB e permitem alto throughput de leitura/escrita.
- Escala horizontal: aumentar instâncias web e workers; utilizar Redis/MongoDB em cluster gerenciado para consistência e disponibilidade.
- Filas: usar workers (supervisor/systemd/container) para processar jobs; monitore backlogs e retries.
- Consistência eventual: contadores em Redis aplicados em batches ao MongoDB (bom trade-off para alta carga). Para contagem estritamente consistente considerar gravação síncrona ou soluções de contagem distribuída.

### Melhorias possíveis
- Usar scripts Lua para operações atômicas em Redis (caso necessário).
- Implementar métricas e monitoramento (Prometheus + Grafana).
- Migrate para time-series DB ou analytics pipeline para análises de tráfego.
- Adicionar job de limpeza para documentos expirados (`expire_at`).

## Segurança e boas práticas
- API keys geradas automaticamente em `User::boot()` e armazenadas em `api_key`.
- Middleware `ValidateApiHeaders` valida `Authorization: Bearer <key>` e injeta `authenticated_user` no request.
- Validações de request aplicadas nos controllers.
- Sanitização de redirect: o serviço adiciona `http://` quando necessário para evitar redirects malformados.

## Como rodar (resumo rápido)
1. Copie `.env.example` para `.env` e configure conexões `mongodb`, `redis` e `queue`.
2. Instale dependências:

```bash
composer install
npm install && npm run build
```

3. Rode seeders (opcional): `php artisan db:seed`
4. Inicie o servidor e workers:

```bash
php artisan serve
php artisan queue:work --queue=default
```

5. Agende `SyncUrlClicks` via `schedule` ou crie um cron que rode `php artisan schedule:run` a cada minuto.

## Arquivos de referência
- Eventos: [app/Events/UrlVisited.php](app/Events/UrlVisited.php)
- Listeners: [app/Listeners/IncrementUrlClicks.php](app/Listeners/IncrementUrlClicks.php)
- Jobs: [app/Jobs/SyncUrlClicks.php](app/Jobs/SyncUrlClicks.php)
- Services: [app/Services/UrlService.php](app/Services/UrlService.php)
- Middleware: [app/Http/Middleware/ValidateApiHeaders.php](app/Http/Middleware/ValidateApiHeaders.php), [app/Http/Middleware/RateLimitByPlan.php](app/Http/Middleware/RateLimitByPlan.php)

## Próximos passos recomendados
- Adicionar exemplos de requests (curl) na seção de API.
- Documentar rotas em `routes/api.php` e `routes/web.php`.
- Implementar testes para fluxos críticos (encurtar, redirect, rate-limit, sync job).

---

Se quiser, eu posso também:
- criar este `README.md` no repositório (já criado).
- adicionar exemplos de requisições `curl` e badge de CI.

## API - Rotas e exemplos (documentação)
As rotas documentadas no projeto podem ser expostas sob o prefixo `/api` quando você for implementar a API. Abaixo estão os endpoints principais (mesma lógica das rotas web):

- POST /api/url
	- Descrição: Encurta uma URL.
	- Headers: `Authorization: Bearer <API_KEY>`, `Content-Type: application/json`
	- Body (JSON): { "original_url": "https://exemplo.com" }
	- Sucesso (200):

```json
{
	"status": 200,
	"data": { "short_url": "https://HOST/url/<shortCode>" },
	"message": "URL encurtada com sucesso",
	"RateLimit-Remaining-Day": 123
}
```

	- Erros: 400 validação, 401 API key inválida, 429 rate-limit, 500 erro interno.

- GET /url/{shortCode}
	- Descrição: Redireciona para a URL original (pública — não precisa de API key).
	- Comportamento: retorna um redirect 302 para a URL (adiciona `http://` se necessário).

- POST /api/url/stats
	- Descrição: Recupera estatísticas para um `short_code`.
	- Headers: `Authorization: Bearer <API_KEY>`, `Content-Type: application/json` (quando for API)
	- Body (JSON): { "short_code": "abc123" } ou (web) form `url=https://HOST/url/abc123`
	- Sucesso (200):

```json
{
	"status": 200,
	"data": {
		"url": {
			"original_url": "https://exemplo.com",
			"short_code": "abc123",
			"clicks": 42,
			"created_at": "2025-06-10T12:00:00Z",
			"expire_at": "2025-06-17T12:00:00Z"
		}
	},
	"message": "Estatísticas recuperadas com sucesso",
	"RateLimit-Remaining-Day": 120
}
```

Observações:
- Use o middleware `ValidateApiHeaders` para validar `Authorization: Bearer <key>` e injetar `authenticated_user`.
- Aplique `RateLimitByPlan` nas rotas da API para limitar requisições diárias por `plan.daily_limit`.
- Redis é usado para cache de `short_code` → `original_url` e para chaves `clicks:{short_code}`. O job `SyncUrlClicks` consolida cliques no MongoDB.

Exemplos `curl` rápidos:

```bash
# Encurtar (API)
curl -X POST https://HOST/api/url \
	-H "Authorization: Bearer $API_KEY" \
	-H "Content-Type: application/json" \
	-d '{"original_url":"https://example.com"}'

# Estatísticas (API)
curl -X POST https://HOST/api/url/stats \
	-H "Authorization: Bearer $API_KEY" \
	-H "Content-Type: application/json" \
	-d '{"short_code":"abc123"}'

# Redirecionamento direto (público)
curl -I https://HOST/url/abc123
```

Se quiser, eu adiciono esses exemplos ao `routes/api.php` (comentários) ou gero testes/coleções Postman para facilitar integração.
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


