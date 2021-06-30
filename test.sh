#!/bin/bash

res=`diff <(php script.php input.csv test) output.csv`

if [ "$?" == "0" ]; then
    echo "Passed"
else
    echo "Failed"
fi