# Pizzaria

Project for pizzaria website. In development.

## Requirements

* [PHP version 8.4+](https://www.php.net/downloads.php)
* [Composer](https://getcomposer.org/download/)
* [Make](https://tilburgsciencehub.com/topics/automation/automation-tools/makefiles/make/)
* [Docker](https://docs.docker.com/)

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
db-migrate
```

### Start service
```bash
make serve
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
* Unit tests [ ]