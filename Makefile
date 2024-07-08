SAIL := ./vendor/bin/sail

## Build app
build:
	$(SAIL) build --no-cache

## Launch app
docker-up:
	$(SAIL) up -d

## Kill app
docker-down:
	$(SAIL) down

## Run db migrations
db-migrate:
	$(SAIL) artisan migrate

## Reset local db
db-reset:
	$(SAIL) artisan migrate:reset

## Seed local db
db-seed:
	$(SAIL) artisan db:seed
