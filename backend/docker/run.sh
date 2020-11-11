#!/bin/bash

export COMPOSE="docker-compose -f docker-compose.yml"

if [ $# -gt 0 ]; then
  if [ "$1" == "art" ]; then
    shift 1
    $COMPOSE exec php-fpm php artisan "$@"

    exit
  fi

  $COMPOSE "$@"

  exit
fi

$COMPOSE ps
