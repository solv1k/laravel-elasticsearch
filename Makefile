install:
	cp .env.example .env && \
	npm install --legacy-peer-deps && \
	npm run build && \
	composer install && \
	php artisan key:generate && \
	./vendor/bin/sail build --no-cache
seed:
	./vendor/bin/sail artisan db:seed
reindex:
	./vendor/bin/sail artisan es:reindex:articles
up:
	./vendor/bin/sail up -d && \
	./vendor/bin/sail artisan migrate
down:
	./vendor/bin/sail down