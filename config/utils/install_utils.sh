#!/bin/bash

sed -i "/#Wesic extended commands/d" ~/.bashrc
sed -i "/git-tree/d" ~/.bashrc
sed -i "/alias rmd/d" ~/.bashrc
sed -i "/alias rmdf/d" ~/.bashrc
sed -i "/alias st/d" ~/.bashrc
sed -i "/alias css-up/d" ~/.bashrc

printf "\n" >> ~/.bashrc
echo "#Wesic extended commands" >> ~/.bashrc

echo alias git-tree="'git log --graph --oneline --all'" >> ~/.bashrc
echo alias rmd="'rm -R'" >> ~/.bashrc
echo alias rmdf="'rm -Rf'" >> ~/.bashrc
echo alias st="'git status'" >> ~/.bashrc
echo alias css-up="'sass --watch public/scss:public/css --cache ../.sass-cache --style compressed'" >> ~/.bashrc

