#!/usr/bin/env bash
set -eo pipefail

git pull --quiet
vendor/bin/composer install --quiet

