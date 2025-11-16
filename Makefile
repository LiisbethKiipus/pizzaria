.PHONY: db-start db-clean db-migrate be-serve fe-serve install

db-start:
	docker-compose up

db-clean:
	docker-compose down -v

db-migrate:
	php artisan migrate

be-serve:
	php artisan serve

fe-serve:
	npm run dev

install:
	composer install
	npm install
	php artisan key:generate
