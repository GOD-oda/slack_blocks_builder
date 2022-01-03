.PHONY: setup
setup:
	$(MAKE) build
	docker compose run --rm app composer install

.PHONY: build
build:
	docker compose build

.PHONY: test
test:
	docker compose run --rm app composer test