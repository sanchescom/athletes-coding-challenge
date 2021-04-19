.DEFAULT_GOAL := help

help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

# ENGINE_EXEC=docker-compose exec laravel
# WWWUSER:=$(shell id -u)
# WWWGROUP:=$(shell id -g)
#
# export WWWGROUP
# export WWWUSER

############
## DEV TASKS
############
start: ## Execute this command to setup the dev env
# 	docker-compose build
# 	docker-compose up -d --force-recreate
# 	docker-compose exec laravel.test php artisan migrate
	composer install
	npm install --loglevel silent
	./vendor/bin/sail up -d
	./vendor/bin/sail artisan migrate
	./vendor/bin/sail npm install --loglevel silent
	./vendor/bin/sail npm run dev

stop: ## Stop all containers properly
	./vendor/bin/sail down
