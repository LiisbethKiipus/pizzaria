# Pizzaria Project

Pizzaria website project. In development. Able to manage users and menu items.

Example data with the following roles:

- **Admin:** Full access to all features
- **Manager:** Can create, read, update, and delete menu items; can view users
- **Employee:** Can view menu items only

Example data users can be found in DatabaseSeeder.php.

Login as user at page [http://localhost:8000/login](http://localhost:8000/login)

## Requirements

- [Docker Desktop](https://www.docker.com/products/docker-desktop/)

## How to run

### 1. Setup env

Copy .env.example -> .env

### 2. Start Docker service (it takes a minute after starting)

**With Make:**

```bash
make start
```

**Without Make:**

```bash
docker compose up -d
```


## Techstack

- ReactJS (TS)
- Laravel (PHP)
- MariaDB
- Docker
- Tailwind
- GitHub Actions

## Roadmap

### Step 1

- [X] Able to configure employee permissions
- [X] Able to configure menu
- [X] Client side website

### Step 2

- [ ] Client is able to select items they want to order
- [ ] Client is able to send out an order
- [ ] Employees are able to see the order

### Step 3

- [ ] Clients are able to see the status of their order in real time
- [ ] Employees are able to update the state of order in real time

### Nice to haves

- [x] Code analyzers and linters
- [x] GitHub Actions running tests and analyzers
- [x] Dockerize the entire project
- [ ] Able to upload menu item pictures
- [x] Unit tests
- [ ] Deploy the website

## Useful commands

### Stop and clean Docker services

**With Make:**

```bash
make clean
```

**Without Make:**

```bash
docker compose down -v
```

### Generate types when making endpoint changes

**With Make:**

```bash
make gen-t
```

**Without Make:**

```bash
docker compose exec app php artisan ziggy:generate --types
```

### Run tests

**With Make:**

```bash
make test
```

**Without Make:**

```bash
docker compose exec app php artisan config:clear --ansi
docker compose exec app php artisan test
docker compose exec vite npm run types
```

### Run linters

**With Make:**

```bash
make lint
```

**Without Make:**

```bash
docker compose exec vite npm run lint
docker compose exec app php vendor/bin/phpstan analyse --memory-limit=512M
docker compose exec app php vendor/bin/phpcs
```

### Fix linters

**With Make:**

```bash
make lint-fix
```

**Without Make:**

```bash
docker compose exec vite npm run lint:fix
docker compose exec app php vendor/bin/phpcbf
```

### Run migrations

**With Make:**

```bash
make db-migrate
```

**Without Make:**

```bash
docker compose exec app php artisan migrate
```

### Reload seed data

**With Make:**

```bash
make fresh-seed
```

**Without Make:**

```bash
docker compose exec app php artisan migrate:fresh --seed
```

### Install dependencies

**With Make:**

```bash
make install
```

**Without Make:**

```bash
docker compose exec app composer install
docker compose exec vite npm install
docker compose exec app php artisan key:generate
```

### See logs

**With Make:**

```bash
make logs
```

**Without Make:**

```bash
docker compose logs -f
```