PHP_DOCKER_SERVICE=php

shell: docker-compose.yaml
	docker-compose run --rm --remove-orphans --entrypoint=/bin/sh ${PHP_DOCKER_SERVICE}

up: docker-compose.yaml
	docker-compose up -d --remove-orphans nginx

down:
	docker-compose down --remove-orphans

check: composer.json
	docker-compose run --rm --entrypoint=composer ${PHP_DOCKER_SERVICE} run check

cs-fix: composer.json
	docker-compose run --rm --entrypoint=composer ${PHP_DOCKER_SERVICE} run cs-fix

