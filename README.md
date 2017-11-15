# Développement backend


## Installation des alias (!)

Ouvrir un terminal (git bash sous windows)
```bash
$ cd /chemin/vers/projet/Wesic
$ chmod +x .install.sh
$ ./install.sh
```
Fermer et ouvrir à nouveau le terminal

## Lancement du docker 

Pour lancer le docker :
```bash
$ docker-up
```
Pour stopper le docker : 
```bash
$ docker-down
```
## Recupérer le .sql 

Lorsque vous lancez docker-down, le fichier wesic.sql va être exporté vers .docker/database/
Par défaut, le dossier est ignoré par git par **SECURITÉ**.

Veillez à ne **jamais** commit le fichier sql sur le repo !

## Accès au serveur

*Par défaut les identifiants sql sont root:root*
### php 
* Windows : 	[192.168.99.100](http://192.168.99.100)
* Linux : 	[localhost](http://localhost)

### Phpmyadmin
* Windows : 	[192.168.99.100:8080](http://192.168.99.100:8080)
* inux :		[localhost:8080](http://localhost:8080)

Le serveur mysql est sur le port 3306 (par défaut)


## Divers
### Installation des alias supplémentaires

Ouvrir un terminal (git bash sous windows)
```bash
$ cd /chemin/vers/projet/Wesic
$ chmod +x .install_utils.sh
$ ./install.sh
```

Cela permet d'obtenir les commandes suivantes : 
```bash
$ git-tree # affiche l'arbre du projet git
$ rmd # supprime un dossier
$ rmdf # supprimer un dossier avec l'option --force
$ st # alias de git status
```	

N'hésitez pas à en proposer d'autres ! 
