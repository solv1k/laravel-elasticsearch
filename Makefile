install:
	cp .env.example .env && \
	composer install && \
	php artisan key:generate && \
	./vendor/bin/sail build --no-cache
seed:
	./vendor/bin/sail artisan db:seed
up:
	./vendor/bin/sail up -d && \
	./vendor/bin/sail artisan migrate
down:
	./vendor/bin/sail down