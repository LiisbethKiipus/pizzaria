.PHONY: db-start db-clean

db-start:
	docker-compose up

db-clean:
	docker-compose down -v

db-migrate:
	php artisan migrate

install:
	composer install
	npm install
	php artisan key:generate
