#!/bin/bash
FILE1=$1
echo alias docker-up='docker-compose up -d' >> /c/Users/$FILE1/.bashrc
echo alias dump-database='docker exec wesic-mariadb /usr/bin/mysqldump -u root --password=root wesic > wesic.sql' >> /c/Users/$FILE1/.bashrc
echo alias docker-down='dump-do && mv ./wesic.sql ./.docker/database/wesic.sql && docker-compose down' >> /c/Users/$FILE1/.bashrc