# Pizzaria

Project for pizzaria website. In development. Able to manage users and menu items.

Example data with the following roles:

- **Admin:** Full access to all features
- **Manager:** Can create, read, update, and delete menu items; can view users
- **Employee:** Can view menu items only

Example data users can be found in [DatabaseSeeder.php](\database\seeders\DatabaseSeeder.php).

Login as user at page [http://localhost:8000/login](http://localhost:8000/login)

## Requirements

* [PHP version 8.4+](https://www.php.net/downloads.php)
* [Composer](https://getcomposer.org/download/)
* [Make](https://tilburgsciencehub.com/topics/automation/automation-tools/makefiles/make/)
* [Node v24](https://nodejs.org/en/download)

## How to run

### Setup env
Copy .env.example -> .env

### Install dependencies
```bash
make install
```

### Run database
```bash
make db-start
```

### Run migrations
```bash
make db-migrate
```

### Start backend service
```bash
make be-serve
```

### Start frontend service
```bash
make fe-serve
```

## Techstack

* React (TS)
* Laravel (PHP)
* MariaDB
* Docker
* Tailwind

## Roadmap

### Step 1 [ ]

* Able to configure employee permissions
* Able to configure menu 
* Client side website

### Step 2 [ ]

* Client is able to select items they want to order
* Client is able to send out an order
* Employees are able to see the order

### Step 3 [ ]

* Clients are able to see the status of their order in real time
* Employees are able to update the state of order in real time

### Nice to haves

* Code analyzers and linters [X]
* GitHub Actions running tests and analyzers [X]
* Dockerize the entire project [ ]
* Able to upload menu item pictures [ ]
* Unit tests [X]

## Useful commands

### Generate types when making endpoint changes
```bash
make gen-t
```

### Run tests
```bash
    make test
```

### Run linters
```bash
    make lint
```

### Fix linters
```bash
    make lint-fix
```

### Reload seed data
```bash
    make fresh-seed
```
