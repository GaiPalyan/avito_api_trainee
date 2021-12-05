start:
	php artisan serve
setup:
	composer install
	cp -n .env.example .env || true
	touch database/database.sqlite || true
	php artisan key:gen --ans
migrate:
	php artisan migrate
clear:
	php artisan route:clear
	php artisan view:clear
	php artisan cache:clear
	php artisan config:clear
lint:
	composer phpcs
lint-fix:
	composer phpcbf