## Setup

1. Clone the repository
2. Copy the environment files:
```bash
   cp .env.example .env
   cp app/.env.example app/.env
```
3. Set your `API_KEY` in `app/.env`. You can generate the key with the following script from inside the container.
```bash
   php artisan tinker --execute="echo \Illuminate\Support\Str::random(64);"
```

4. Start the containers:
```bash
   docker compose up -d
```

The app will be available at `http://localhost:8000`.