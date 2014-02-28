#!/bin/sh

bin/doctrine orm:schema-tool:drop --force
bin/doctrine orm:schema-tool:create
