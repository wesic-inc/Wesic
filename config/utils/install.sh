#!/bin/bash

sed -i "/#Wesic commands/d" ~/.bashrc
sed -i "/alias docker-up/d" ~/.bashrc
sed -i "/alias docker-down/d" ~/.bashrc
sed -i "/alias dump-database/d" ~/.bashrc
sed -i "/alias docker-build/d" ~/.bashrc

printf "\n" >> ~/.bashrc
echo "#Wesic commands" >> ~/.bashrc
echo alias docker-up="'docker-compose up -d'" >> ~/.bashrc
echo alias dump-database="'docker exec wesic-mariadb /usr/bin/mysqldump -u root --password=root --databases wesic > wesic.sql'" >> ~/.bashrc
echo alias docker-down="'dump-database && mv ./wesic.sql ./.docker/database/ && docker-compose down'" >> ~/.bashrc
echo alias docker-build="'docker-compose build'" >> ~/.bashrc
echo alias docker-restart="'docker-composer down && docker-compose up'" >> ~/.bashrc
echo alias docker-restart="'docker-compose down && docker-compose up'" >> ~/.bashrc
echo alias docker-php="'docker exec -ti wesic_php_1 bash'" >> ~/.bashrc