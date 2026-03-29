# arobit/erp-media

`arobit/erp-media` is a Laravel 12+ package for handling ERP media uploads with a Service-Contract-DTO architecture.

## Installation

```bash
composer require arobit/erp-media
```

Publish configuration:

```bash
php artisan vendor:publish --tag=erp-media-config
```

Run migrations:

```bash
php artisan migrate
```

## API Endpoint

- `POST /api/erp-media/media`

Payload fields:

- `file` (required file, max 10MB)
- `disk` (optional string)
- `directory` (optional string)
- `visibility` (`public` or `private`)

## Architecture

- Controllers only orchestrate request/response.
- Validation and DTO mapping happen in `StoreMediaRequest`.
- Business workflow flows through `MediaServiceContract` -> `MediaRepositoryContract`.
- Persistence is handled by the repository and `Media` model.

## Testing

```bash
composer test
```
