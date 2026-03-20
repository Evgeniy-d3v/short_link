
php:
	docker compose exec php bash

project_init:
	@if [ ! -f .env ]; then \
		cp .env.example .env; \
		echo ".env created"; \
	else \
		echo ".env already exists"; \
	fi
	docker compose up -d
	sleep 5
	docker compose exec php composer install
	docker compose exec php php artisan key:generate
	docker compose exec php php artisan migrate --force
