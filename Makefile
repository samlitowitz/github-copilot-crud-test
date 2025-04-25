DOCKER_SERVICE=php

bash: docker-compose.yaml
	docker-compose run --rm --remove-orphans --entrypoint=/bin/bash ${DOCKER_SERVICE}

up: docker-compose.yaml
	docker-compose up -d --remove-orphans php

down:
	docker-compose down --remove-orphans

check: composer.json
	docker-compose run --rm --entrypoint=composer ${DOCKER_SERVICE} run check

cs-fix: composer.json
	docker-compose run --rm --entrypoint=composer ${DOCKER_SERVICE} run cs-fix

