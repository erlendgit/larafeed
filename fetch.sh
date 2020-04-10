#!/usr/bin/env bash

ROOT_DIR=`realpath $(dirname $0)`

cd $ROOT_DIR

php artisan feed:fetch

