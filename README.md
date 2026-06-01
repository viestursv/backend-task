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