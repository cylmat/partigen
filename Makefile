SHELL := /bin/bash

.PHONY: spec

spec:
	vendor/bin/phpspec run

md:
	vendor/bin/phpmd src ansi cleancode,codesize,controversial,design,naming,unused