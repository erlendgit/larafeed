#!/usr/bin/env bash
set -eo pipefail

git pull --quiet
composer install --quiet

