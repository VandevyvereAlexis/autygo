setup:
	docker compose build --no-cache
	docker compose up -d
	docker compose exec autygo-api composer install
	docker compose exec autygo-api php artisan migrate --seed

dev:
	docker compose up -d

down:
	docker compose down

logs:
	docker compose logs -f

test:
	docker compose run autygo-tests npm test