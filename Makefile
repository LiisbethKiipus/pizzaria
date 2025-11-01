.PHONY: db-start db-clean db-migrate serve install

db-start:
	docker-compose up

db-clean:
	docker-compose down -v

db-migrate:
	php artisan migrate

serve:
	php artisan serve

install:
	composer install
	npm install
	php artisan key:generate
