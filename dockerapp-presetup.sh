#!/bin/bash

docker run --rm -v .:/app composer:2.2  config --no-plugins allow-plugins.kylekatarnls/update-helper false
docker run --rm -v .:/app composer install --ignore-platform-reqs
