SHELL := /bin/bash

.PHONY: md, spec

md:
	vendor/bin/phpmd src ansi cleancode,codesize,controversial,design,naming,unused

spec:
	vendor/bin/phpspec run