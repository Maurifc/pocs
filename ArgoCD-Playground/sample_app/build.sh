#!/bin/bash

for color in 'red' 'blue' 'green';
do
    echo "Building: ${color}"
    docker image build -t maurifc/sample-app:"$color" --build-arg COLOR="$color" .
    echo
done