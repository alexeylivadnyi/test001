#!/bin/bash

rm -rf ../panel

cd ../../panel
npx vue-cli-service build
mv ./dist/ ../backend/panel
cd ../backend/docker
