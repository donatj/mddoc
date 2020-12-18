SRC_FILES = $(shell find src -type f -name '*.php')

README.md: $(SRC_FILES)
	composer/bin/mddoc

.PHONY: cs
cs:
	./vendor/bin/phpcs

.PHONY: cbf
cbf:
	./vendor/bin/phpcbf

.PHONY: fix
fix: cbf
	vendor/bin/php-cs-fixer fix
