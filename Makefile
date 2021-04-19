.DEFAULT_GOAL := help

help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

############
## DEV TASKS
############
start: ## Execute this command to setup the dev env
	composer install
	npm install --loglevel silent
	test -f .env || cp .env.example .env
	./vendor/bin/sail up -d
	./vendor/bin/sail artisan key:generate
	./vendor/bin/sail artisan migrate --seed
	./vendor/bin/sail npm install --loglevel silent
	./vendor/bin/sail npm run dev
	echo "Open browser http://localhost:8081/"

stop: ## Stop all containers properly
	./vendor/bin/sail down

test:
	./vendor/bin/phpunit
