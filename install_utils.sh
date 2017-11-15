#!/bin/bash

sed -i "/#Wesic extended commands/d" ~/.bashrc
sed -i "/git-tree/d" ~/.bashrc
sed -i "/alias rmd/d" ~/.bashrc
sed -i "/alias rmdf/d" ~/.bashrc
sed -i "/alias st/d" ~/.bashrc
sed -i "/docker stop/d" ~/.bashrc
sed -i "/docker rm/d" ~/.bashrc

printf "\n" >> ~/.bashrc
echo "#Wesic extended commands" >> ~/.bashrc

echo alias git-tree="'git log --graph --oneline --all'" >> ~/.bashrc
echo alias rmd="'rm -R'" >> ~/.bashrc
echo alias rmdf="'rm -Rf'" >> ~/.bashrc
echo alias st="'git status'" >> ~/.bashrc
echo alias stop-all-container="'docker stop $(docker ps -qa)'" >> ~/.bashrc
echo alias rm-all-container="'docker rm $(docker ps -qa)'" >> ~/.bashrc