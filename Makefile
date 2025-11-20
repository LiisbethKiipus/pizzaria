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

gen-t:
	php artisan ziggy:generate --types

test:
	php artisan config:clear --ansi
	php artisan test
	npm run types

lint:
	npm run lint
	php vendor/bin/phpstan analyse  --memory-limit=512M
	php vendor/bin/phpcs

lint-fix:
	npm run lint:fix
	php vendor/bin/phpcbf

install:
	composer install
	npm install
	php artisan key:generate

