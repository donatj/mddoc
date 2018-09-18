SRC_FILES = $(shell find example src -type f -name '*.php')

README.md: $(SRC_FILES)
	composer/bin/mddoc

.PHONY: fix
fix:
	vendor/bin/php-cs-fixer fix
