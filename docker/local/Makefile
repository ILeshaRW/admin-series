SHELL=/bin/bash -e

.DEFAULT_GOAL := help

# директория запуска
__DIR__ := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

# ключевые файлы потому что запуск может производится из другой папки
ENV_FILE := '${__DIR__}.env'
DOCKER_COMPOSE_FILE := '${__DIR__}docker-compose.yml'
# docker-compose с подвязанныеми файлами
DOCKER_COMPOSE := 'docker-compose -f ${DOCKER_COMPOSE_FILE} --env-file ${ENV_FILE}'

help: ## This help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

setup: ## Начальная установка приложения
	@cp '${__DIR__}../../.env.example' '${__DIR__}../../.env'
	@cat '${__DIR__}../../.env.example' '${ENV_FILE}.example' > '${ENV_FILE}'
	@'${DOCKER_COMPOSE}' build
	@make up
	@'${DOCKER_COMPOSE}' exec php composer install --ignore-platform-req=ext-zip
	@'${DOCKER_COMPOSE}' exec php php artisan key:generate
	@'${DOCKER_COMPOSE}' exec php php artisan migrate:fresh
	@'${DOCKER_COMPOSE}' exec php php artisan db:seed
	@echo -e "Make: Приложение установлено и запущено. \n"

up: ## Запуск контейнеров
	@'${DOCKER_COMPOSE}' up -d

down: ## Остановка контейнеров
	@'${DOCKER_COMPOSE}' down

bash: ## Доступ в php контейнер
	@'${DOCKER_COMPOSE}' exec php bash

test: ## Запуск тестов
	@'${DOCKER_COMPOSE}' exec php bash -c 'XDEBUG_MODE=off php artisan test'

insights: ## Проверка insights
	@'${DOCKER_COMPOSE}' exec php bash -c 'XDEBUG_MODE=off php artisan insights'

stan: ## Проверка phpstan
	@'${DOCKER_COMPOSE}' exec php bash -c 'XDEBUG_MODE=off ./vendor/bin/phpstan analyse'

cs: ## Проверка phpcs
	@'${DOCKER_COMPOSE}' exec php bash -c 'XDEBUG_MODE=off ./vendor/bin/phpcs'

default: help
