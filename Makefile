SHELL := /bin/bash

.PHONY: spec

spec:
	vendor/bin/phpspec run