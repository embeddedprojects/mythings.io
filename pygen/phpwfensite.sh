#!/bin/bash

cp pages/adresse.php pages/$1.php
cp widgets/widget.adresse.php widgets/widget.$1.php

echo "os.system('pagegen.py $1 pages/')" >> ../pygen/phpwfgen.py

