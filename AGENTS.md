# AGENTS.md

## Build rules
- Laravel 12+ compatible
- Service-Contract-DTO architecture
- No business logic in controllers
- Use readonly DTOs where appropriate
- Use PSR-4 namespaces
- Prefer strict typing
- Package must be composer-installable
- Use UUID for media IDs
- JSON API style responses
- Add tests for core workflows

## Review guidelines
- Flag broken namespaces
- Flag missing bindings in service provider
- Flag schema/index issues
- Flag file upload security issues
