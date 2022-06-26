SHELL := /bin/bash

.PHONY: md, spec

md:
	bin/phpmd src ansi cleancode,codesize,controversial,design,naming,unused

spec:
	bin/phpspec run