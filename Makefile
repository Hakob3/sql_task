.PHONY: $(MAKECMDGOALS)

.DEFAULT_GOAL := help
SHELL := /bin/bash

up: #Запуск наших контейнеров
	docker-compose up -d

up-alone: #Запуск наших контейнеров, остановка других контейнеров, которые остались открытыми
	docker-compose up -d --remove-orphans

down: #Остановка контейнера
	docker-compose down

down-all: #Остановка наших контейнеров + всех остальных, которые остались открытыми
	docker-compose down --remove-orphans

composer-install: #Запуск установки пакетов композером
	docker-compose exec app composer install

script:
	docker-compose exec app php public/index.php