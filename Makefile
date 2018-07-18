NAME = wesic/devtool
VERSION = 0.0.1

.PHONY: up
up:
	@docker-compose up -d
	@printf "Wesic Docker dev container is up now"

.PHONY: down
down:
	@docker-compose down

.PHONY: restart
restart:
	@docker-compose restart

.PHONY: stop
stop:
	@docker-compose stop

.PHONY: build
build:
	@docker-compose build

.PHONY: sh-php
sh-php:
	@docker exec -ti wesic_php_1 bash
