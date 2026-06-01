## Requirements

- Docker
- Docker Compose

## Setup

1. Clone the repository
2. Copy the environment files:
```bash
   cp .env.example .env
   cp app/.env.example app/.env
```
3. Generate an API key and set it in `app/.env`:
```bash
openssl rand -hex 32
```

4. Start the containers:
```bash
   docker compose up -d
```

The app will be available at `http://localhost:8000`.

## Running Tests

```bash
docker exec -it backend-task-app-1 bash
php artisan test
```

## API Endpoints

### Public

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/public/product-sets/{slug}` | Get a published product set |

### Admin

Restricted endpoints require an `X-API-KEY` header.

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/admin/product-sets` | Create a product set |
| PUT | `/api/admin/product-sets/{id}` | Update a product set |
| POST | `/api/admin/products` | Create a product |
| PUT | `/api/admin/products/{id}` | Update a product |
| DELETE | `/api/admin/products/{id}` | Delete a product |
| PUT | `/api/admin/vat-rate` | Sync VAT rate and recalculate product prices |

```bash
curl -X POST http://localhost:8000/api/admin/product-sets \
  -H "Content-Type: application/json" \
  -H "X-API-KEY: your-api-key" \
  -d '{
    "name": "Gaming Bundle",
    "products": [
      {
        "sku": "PS5-001",
        "name": "PlayStation 5",
        "type": "device",
        "condition": "new",
        "description_title": "Sony PS5",
        "description_text": "Latest PlayStation console",
        "price_wo_vat": 500.00,
        "wholesale_price": 450.00,
        "published": true
      },
      {
        "sku": "INSTALL-001",
        "name": "Installation Service",
        "type": "service",
        "condition": "new",
        "description_title": "Setup Service",
        "description_text": "Professional installation",
        "price_wo_vat": 50.00,
        "wholesale_price": 25.00,
        "published": false
      }
    ]
  }'
```