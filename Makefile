dc = docker compose

start:
	$(dc) up -d

clean:
	$(dc) down -v

db-migrate:
	$(dc) exec app php artisan migrate

fresh-seed:
	$(dc) exec app php artisan migrate:fresh --seed

gen-t:
	$(dc) exec app php artisan ziggy:generate --types

test:
	$(dc) exec app php artisan config:clear --ansi
	$(dc) exec app php artisan test
	$(dc) exec vite npm run types

lint:
	$(dc) exec vite npm run lint
	$(dc) exec app php vendor/bin/phpstan analyse --memory-limit=512M
	$(dc) exec app php vendor/bin/phpcs

lint-fix:
	$(dc) exec vite npm run lint:fix
	$(dc) exec app php vendor/bin/phpcbf

install:
	$(dc) exec app composer install
	$(dc) exec vite npm install
	$(dc) exec app php artisan key:generate

logs:
	$(dc) logs -f
