# https://github.com/casey/just

default:
  @just --list --unsorted

# cleans up the current docker-compose environment
docker-clean:
  @docker-compose down -v --remove-orphans
  @sudo rm -rf backups build dist xdebug

# this starts up the docker environment. add --force-recreate if necessary
docker-start:
  @docker compose up
