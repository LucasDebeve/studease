#!/bin/bash

if [[ -e ./composer.json ]]; then
  composer install
else
  echo "Pas de projet composer dans le répertoire courant"
fi
if [[ -e ./package.json ]; then
  npm install
else
  echo "Pas de projet npm dans le répertoire courant"
fi